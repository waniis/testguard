<?php

class LpcPickupSelection extends LpcComponent {
    const AJAX_TASK_NAME = 'pickup_selection';

    const PICKUP_LOCATION_ID_META_KEY = '_lpc_meta_pickUpLocationId';
    const PICKUP_LOCATION_LABEL_META_KEY = '_lpc_meta_pickUpLocationLabel';
    const PICKUP_PRODUCT_CODE_META_KEY = '_lpc_meta_pickUpProductCode';

    const PICKUP_LOCATION_SESSION_VAR_NAME = 'lpc_pickUpInfo';

    protected $ajaxDispatcher;

    public function __construct(LpcAjax $ajaxDispatcher = null) {
        $this->ajaxDispatcher = LpcRegister::get('ajaxDispatcher', $ajaxDispatcher);

        add_filter('woocommerce_order_button_html', [$this, 'preventPlaceOrderButton'], 10, 2);
        add_action('woocommerce_checkout_process', [$this, 'preventCheckoutProcess']);
    }

    public function getDependencies() {
        return ['ajaxDispatcher'];
    }

    public function init() {
        $this->listenToPickUpSelection();
        $this->savePickUpSelectionOnOrderProcessed();
        $this->applyPickupAddress();
    }

    protected function listenToPickUpSelection() {
        $this->ajaxDispatcher->register(self::AJAX_TASK_NAME, [$this, 'pickUpLocationListener']);
    }

    public function pickUpLocationListener() {
        $pickUpInfo = LpcHelper::getVar(self::PICKUP_LOCATION_SESSION_VAR_NAME, null, 'array');
        WC()->session->set(self::PICKUP_LOCATION_SESSION_VAR_NAME, $pickUpInfo);

        return $this->ajaxDispatcher->makeSuccess(
            [
                'html' => LpcHelper::renderPartial(
                    'pick_up' . DS . 'pick_up_info.php',
                    ['relay' => $pickUpInfo]
                ),
            ]
        );
    }

    public function getCurrentPickUpLocationInfo() {
        return WC()->session->get(self::PICKUP_LOCATION_SESSION_VAR_NAME);
    }

    public function setCurrentPickUpLocationInfo(array $pickUpInfo) {
        WC()->session->set(self::PICKUP_LOCATION_SESSION_VAR_NAME, $pickUpInfo);

        return $this;
    }

    public function getAjaxUrl() {
        return $this->ajaxDispatcher->getUrlForTask(self::AJAX_TASK_NAME);
    }

    public function savePickUpSelectionOnOrderProcessed() {
        add_action(
            'woocommerce_checkout_order_processed',
            function ($orderId) {
                $shippings = wc_get_order($orderId)->get_shipping_methods();
                $shipping  = current($shippings);
                if (!empty($shipping)) {
                    $shippingMethod = $shipping->get_method_id();
                    if (LpcRelay::ID == $shippingMethod) {
                        $pickUpInfo = $this->getCurrentPickUpLocationInfo();

                        update_post_meta($orderId, self::PICKUP_LOCATION_ID_META_KEY, $pickUpInfo['identifiant']);
                        update_post_meta($orderId, self::PICKUP_LOCATION_LABEL_META_KEY, $pickUpInfo['nom']);
                        update_post_meta($orderId, self::PICKUP_PRODUCT_CODE_META_KEY, $pickUpInfo['typeDePoint']);
                        WC()->session->set(self::PICKUP_LOCATION_SESSION_VAR_NAME, null);
                    }
                }
            }
        );
    }

    public function preventPlaceOrderButton($orderButton) {
        $wcSession      = WC()->session;
        $wcCart         = WC()->cart;
        $shippingMethod = $wcSession->get('chosen_shipping_methods');
        $needShipping   = $wcCart->needs_shipping();

        if (!$needShipping || empty($shippingMethod) || !in_array(LpcRelay::ID, $shippingMethod)) {
            return $orderButton;
        }

        $relayInfo = $this->getCurrentPickUpLocationInfo();

        if (!empty($relayInfo)) {
            return $orderButton;
        }

        $textButton = __('Please select a pick-up point', 'wc_colissimo');

        return '<button type="submit" disabled class="button alt" name="woocommerce_checkout_place_order" id="place_order">' . $textButton . '</button>';
    }

    public function preventCheckoutProcess() {
        $wcSession      = WC()->session;
        $wcCart         = WC()->cart;
        $shippingMethod = $wcSession->get('chosen_shipping_methods');
        $needShipping   = $wcCart->needs_shipping();

        if (!$needShipping || empty($shippingMethod) || !in_array(LpcRelay::ID, $shippingMethod)) {
            return;
        }

        $relayInfo = $this->getCurrentPickUpLocationInfo();

        if (empty($relayInfo)) {
            throw new Exception(__('Please select a pick-up point', 'wc_colissimo'));
        }

        $customerData            = $wcSession->get('customer');
        $customerShippingCountry = $customerData['shipping_country'];
        $customerPhoneNumber     = isset($_REQUEST['billing_phone']) ? sanitize_text_field(
            wp_unslash($_REQUEST['billing_phone'])
        ) : '';

        // Even if we don't have a shipping phone natively in WooCommerce, we can check if a shipping phone exist if the billing one is empty
        // because a plugin or a theme can add it
        if (empty($customerPhoneNumber) && isset($_REQUEST['shipping_phone']) && !empty($_REQUEST['shipping_phone'])) {
            $customerPhoneNumber = sanitize_text_field(wp_unslash($_REQUEST['shipping_phone']));
        }

        $customerPhoneNumber      = str_replace(' ', '', $customerPhoneNumber);
        $frenchMobileNumberRegex  = '/^(?:(?:\+|00)33|0)(?:6|7)\d{8}$/';
        $belgianMobileNumberRegex = '/^(?:(?:\+|00)32|0)4\d{8}$/';

        if (
            empty($customerPhoneNumber)
            || ('FR' === $customerShippingCountry && !preg_match($frenchMobileNumberRegex, $customerPhoneNumber))
            || ('BE' === $customerShippingCountry && !preg_match($belgianMobileNumberRegex, $customerPhoneNumber))
        ) {
            throw new Exception(
                __(
                    'Please define a mobile phone number for SMS notification tracking',
                    'wc_colissimo'
                )
            );
        }
    }

    public function applyPickupAddress() {
        add_action(
            'woocommerce_checkout_order_created',
            function ($order) {
                if (!$order->has_shipping_method('lpc_relay')) {
                    return;
                }

                $pickupData = $this->getCurrentPickUpLocationInfo();

                $order->set_shipping_address_1(!empty($pickupData['adresse1']) ? $pickupData['adresse1'] : '');
                $order->set_shipping_address_2(!empty($pickupData['adresse2']) ? $pickupData['adresse2'] : '');
                $order->set_shipping_postcode(!empty($pickupData['codePostal']) ? $pickupData['codePostal'] : '');
                $order->set_shipping_city(!empty($pickupData['localite']) ? $pickupData['localite'] : '');
                $order->set_shipping_country(!empty($pickupData['codePays']) ? $pickupData['codePays'] : '');
                $order->set_shipping_company(!empty($pickupData['nom']) ? $pickupData['nom'] : '');
                $order->set_shipping_state('');

                $order->save();
            }
        );
    }
}
