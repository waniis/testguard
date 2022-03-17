<?php

class LpcAdminOrderBanner extends LpcComponent {

    /** @var LpcLabelQueries */
    protected $lpcLabelQueries;

    /** @var LpcShippingMethods */
    protected $lpcShippingMethods;

    /** @var LpcLabelGenerationOutward */
    protected $lpcOutwardLabelGeneration;

    /** @var LpcLabelGenerationInward */
    protected $lpcInwardLabelGeneration;

    /** @var LpcAdminNotices */
    protected $lpcAdminNotices;

    public function __construct(
        LpcLabelQueries $lpcLabelQueries = null,
        LpcShippingMethods $lpcShippingMethods = null,
        LpcLabelGenerationOutward $lpcOutwardLabelGeneration = null,
        LpcLabelGenerationInward $lpcInwardLabelGeneration = null,
        LpcAdminNotices $lpcAdminNotices = null

    ) {
        $this->lpcLabelQueries           = LpcRegister::get('labelQueries', $lpcLabelQueries);
        $this->lpcShippingMethods        = LpcRegister::get('shippingMethods', $lpcShippingMethods);
        $this->lpcOutwardLabelGeneration = LpcRegister::get('labelGenerationOutward', $lpcOutwardLabelGeneration);
        $this->lpcInwardLabelGeneration  = LpcRegister::get('labelGenerationInward', $lpcInwardLabelGeneration);
        $this->lpcAdminNotices           = LpcRegister::get('lpcAdminNotices', $lpcAdminNotices);
    }

    public function init() {
        add_action('current_screen',
            function ($currentScreen) {
                if ('post' === $currentScreen->base && 'shop_order' === $currentScreen->post_type) {
                    LpcHelper::enqueueStyle(
                        'lpc_order_banner',
                        plugins_url('/css/orders/lpc_order_banner.css', LPC_ADMIN . 'init.php'),
                        null
                    );

                    LpcHelper::enqueueScript(
                        'lpc_order_banner',
                        plugins_url('/js/orders/lpc_order_banner.js', LPC_ADMIN . 'init.php'),
                        null,
                        ['jquery-core']
                    );

                    LpcLabelQueries::enqueueLabelsActionsScript();
                }
            }
        );

        add_action('save_post', [$this, 'generateLabel'], 10, 3);
    }

    public function bannerContent($post) {
        $orderId = $post->ID;
        $order   = wc_get_order($post);

        if (empty($this->lpcShippingMethods->getColissimoShippingMethodOfOrder($order))) {
            $warningMessage = __('This order is not shipped by Colissimo', 'wc_colissimo');

            echo '<div class="lpc__admin__order_banner__warning"><span>' . $warningMessage . '</span></div>';

            return;
        }

        $trackingNumbers = [];
        $labelFormat     = [];

        $this->lpcLabelQueries->getTrackingNumbersByOrdersId($trackingNumbers, $labelFormat, [$orderId]);

        $trackingNumbersForOrder = !empty($trackingNumbers[$orderId]) ? $trackingNumbers[$orderId] : [];

        $args  = [];
        $items = $order->get_items();

        $args['lpc_order_items'] = [];

        foreach ($items as $item) {
            $product = $item->get_product();

            $args['lpc_order_items'][] = [
                'id'     => $item->get_id(),
                'name'   => $item->get_name(),
                'qty'    => $item->get_quantity(),
                'weight' => empty($product->get_weight()) ? 0 : $product->get_weight(),
                'price'  => $product->get_price(),
            ];
        }

        $args['postId']               = $orderId;
        $args['lpc_tracking_numbers'] = $trackingNumbersForOrder;
        $args['lpc_label_formats']    = $labelFormat;
        $args['lpc_label_queries']    = $this->lpcLabelQueries;
        $args['lpc_redirection']      = LpcLabelQueries::REDIRECTION_WOO_ORDER_EDIT_PAGE;
        $args['lpc_packaging_weight'] = LpcHelper::get_option('lpc_packaging_weight', 0);
        $args['lpc_shipping_costs']   = empty($order->get_shipping_total()) ? 0 : $order->get_shipping_total();
        echo LpcHelper::renderPartial('orders' . DS . 'lpc_admin_order_banner.php', $args);
    }

    public function generateLabel($post_id, $post, $update) {
        $slug = 'shop_order';

        if (
            !is_admin()
            || $slug != $post->post_type
            || !isset($_REQUEST['lpc__admin__order_banner__generate_label__action'])
            || empty($_REQUEST['lpc__admin__order_banner__generate_label__action'])
        ) {
            return;
        }

        if (empty($_REQUEST['lpc__admin__order_banner__generate_label__items-id'])) {
            return;
        }

        $allItemsId = unserialize(sanitize_text_field(wp_unslash($_REQUEST['lpc__admin__order_banner__generate_label__items-id'])));

        $items = [];
        foreach ($allItemsId as $oneItemId) {
            if (!isset($_REQUEST[$oneItemId . '-checkbox']) || 'on' !== $_REQUEST[$oneItemId . '-checkbox']) {
                continue;
            }

            $items[$oneItemId]['price']  = isset($_REQUEST[$oneItemId . '-price']) ? sanitize_text_field(wp_unslash($_REQUEST[$oneItemId . '-price'])) : 0;
            $items[$oneItemId]['qty']    = isset($_REQUEST[$oneItemId . '-qty']) ? sanitize_text_field(wp_unslash($_REQUEST[$oneItemId . '-qty'])) : 0;
            $items[$oneItemId]['weight'] = isset($_REQUEST[$oneItemId . '-weight']) ? sanitize_text_field(wp_unslash($_REQUEST[$oneItemId . '-weight'])) : 0;
        }

        if (empty($items)) {
            $this->lpcAdminNotices->add_notice('lpc_notice', 'notice-warning', __('You need to select at least one item to generate a label', 'wc_colissimo'));

            return;
        }

        $order         = wc_get_order($post_id);
        $packageWeight = isset($_REQUEST['lpc__admin__order_banner__generate_label__package_weight']) ? sanitize_text_field(wp_unslash($_REQUEST['lpc__admin__order_banner__generate_label__package_weight'])) : 0;
        $totalWeight   = isset($_REQUEST['lpc__admin__order_banner__generate_label__total_weight__input']) ? sanitize_text_field(wp_unslash($_REQUEST['lpc__admin__order_banner__generate_label__total_weight__input'])) : 0;
        $shippingCosts = isset($_REQUEST['lpc__admin__order_banner__generate_label__shipping_costs']) ? sanitize_text_field(wp_unslash($_REQUEST['lpc__admin__order_banner__generate_label__shipping_costs'])) : 0;

        $customParams = [
            'packageWeight' => $packageWeight,
            'totalWeight'   => $totalWeight,
            'items'         => $items,
            'shippingCosts' => $shippingCosts,
        ];

        $outwardOrInward = isset($_REQUEST['lpc__admin__order_banner__generate_label__outward_or_inward']) ? sanitize_text_field(wp_unslash($_REQUEST['lpc__admin__order_banner__generate_label__outward_or_inward'])) : '';

        if ('outward' === $outwardOrInward || 'both' === $outwardOrInward) {
            $this->lpcOutwardLabelGeneration->generate($order, $customParams);
        }

        if ('inward' === $outwardOrInward || ('both' === $outwardOrInward && 'yes' !== LpcHelper::get_option('lpc_createReturnLabelWithOutward', 'no'))) {
            $this->lpcInwardLabelGeneration->generate($order, $customParams);
        }
    }
}
