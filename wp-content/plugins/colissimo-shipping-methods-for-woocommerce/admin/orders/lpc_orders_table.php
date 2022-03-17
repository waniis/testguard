<?php

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
require_once LPC_INCLUDES . 'orders' . DS . 'lpc_order_queries.php';

class LpcOrdersTable extends WP_List_Table {
    const BULK_ACTION_IDS_PARAM_NAME = 'bulk-lpc_action_id';
    const BULK_BORDEREAU_GENERATION_ACTION_NAME = 'bulk-bordereau_generation';
    const BULK_LABEL_DOWNLOAD_ACTION_NAME = 'bulk-label_download';
    const BULK_LABEL_GENERATION_OUTWARD_ACTION_NAME = 'bulk-label_generation_outward';
    const BULK_LABEL_GENERATION_INWARD_ACTION_NAME = 'bulk-label_generation_inward';
    const BULK_LABEL_PRINT_OUTWARD_ACTION_NAME = 'bulk-label_print_outward';
    const BULK_LABEL_PRINT_INWARD_ACTION_NAME = 'bulk-label_print_inward';
    const BULK_LABEL_PRINT_ACTION_NAME = 'bulk-label_print';

    /** @var LpcBordereauGeneration */
    protected $bordereauGeneration;
    /** @var LpcUnifiedTrackingApi */
    protected $unifiedTrackingApi;
    /** @var LpcBordereauDownloadAction */
    protected $bordereauDownloadAction;
    /** @var LpcLabelPackagerDownloadAction */
    protected $labelPackagerDownloadAction;
    /** @var LpcLabelGenerationOutward */
    protected $labelGenerationOutward;
    /** @var LpcLabelGenerationInward */
    protected $labelGenerationInward;
    /** @var LpcLabelPrintAction */
    protected $labelPrintAction;
    /** @var LpcColissimoStatus */
    protected $colissimoStatus;
    /** @var LpcUpdateStatusesAction */
    protected $updateStatuses;
    /** @var LpcLabelQueries */
    protected $labelQueries;

    public function __construct() {
        parent::__construct();

        $this->bordereauGeneration         = LpcRegister::get('bordereauGeneration');
        $this->unifiedTrackingApi          = LpcRegister::get('unifiedTrackingApi');
        $this->bordereauDownloadAction     = LpcRegister::get('bordereauDownloadAction');
        $this->labelPackagerDownloadAction = LpcRegister::get('labelPackagerDownloadAction');
        $this->labelGenerationOutward      = LpcRegister::get('labelGenerationOutward');
        $this->labelGenerationInward       = LpcRegister::get('labelGenerationInward');
        $this->updateStatuses              = LpcRegister::get('updateStatusesAction');
        $this->labelPrintAction            = LpcRegister::get('labelPrintAction');
        $this->colissimoStatus             = LpcRegister::get('colissimoStatus');
        $this->labelQueries                = LpcRegister::get('labelQueries');
    }

    public function get_columns() {
        $columns = [
            'cb'                  => '<input type="checkbox" />',
            'lpc-id'              => __('ID', 'wc_colissimo'),
            'lpc-date'            => __('Date', 'wc_colissimo'),
            'lpc-customer'        => __('Customer', 'wc_colissimo'),
            'lpc-address'         => __('Address', 'wc_colissimo'),
            'lpc-country'         => __('Country', 'wc_colissimo'),
            'lpc-shipping-method' => __('Shipping method', 'wc_colissimo'),
            'lpc-woo-status'      => __('Order status', 'wc_colissimo'),
            'lpc-shipping-status' => __('Status', 'wc_colissimo'),
            'lpc-label'           => sprintf(
                '%s (<span id="lpc__orders_listing__title__outward">%s</span> / <span id="lpc__orders_listing__title__inward">%s</span>)',
                __('Labels', 'wc_colissimo'),
                strtolower(__('Outward', 'wc_colissimo')),
                strtolower(__('Inward', 'wc_colissimo'))
            ),
            'lpc-bordereau'       => __('Bordereau', 'wc_colissimo'),
        ];

        return array_map(
            function ($v) {
                return <<<END_HTML
<span style="font-weight:bold;">$v</span>
END_HTML;
            },
            $columns
        );
    }

    public function prepare_items($args = []) {
        $this->process_bulk_action();

        $optionsFiltersMatchRequestsKey = [
            'lpc_orders_filters_country'         => 'order_country',
            'lpc_orders_filters_shipping_method' => 'order_shipping_method',
            'lpc_orders_filters_status'          => 'order_status',
            'lpc_orders_filters_label_type'      => 'label_type',
            'lpc_orders_filters_woo_status'      => 'order_woo_status',
        ];

        foreach ($optionsFiltersMatchRequestsKey as $oneOptionFilter => $oneRequestKey) {
            if (isset($_REQUEST[$oneRequestKey])) {
                $requestValue = array_map('sanitize_text_field', wp_unslash($_REQUEST[$oneRequestKey]));

                if (false === update_option($oneOptionFilter, $requestValue)) {
                    add_option($oneOptionFilter, $requestValue);
                }
            }
        }

        $filters = $this->lpcGetFilters();

        $columns      = $this->get_columns();
        $hidden       = [];
        $sortable     = $this->get_sortable_columns();
        $total_items  = LpcOrderQueries::countLpcOrders($args, $filters);
        $current_page = $this->get_pagenum();
        $user         = get_current_user_id();
        $screen       = get_current_screen();
        $option       = $screen->get_option('per_page', 'option');

        $per_page = get_user_meta($user, $option, true);

        if (empty($per_page) || $per_page < 1) {
            $per_page = $screen->get_option('per_page', 'default');
        }

        $this->set_pagination_args(
            [
                'total_items' => $total_items,
                'per_page'    => $per_page,
            ]
        );

        $this->_column_headers = [$columns, $hidden, $sortable];
        $this->items           = $this->get_data($current_page, $per_page, $args, $filters);
    }

    protected function column_default($item, $column_name) {
        return $item[$column_name];
    }

    protected function get_data($current_page = 0, $per_page = 0, $args = [], $filters = []) {
        $data      = [];
        $ordersIds = LpcOrderQueries::getLpcOrders($current_page, $per_page, $args, $filters);

        $trackingNumbers = $this->getTrackingNumbersFormated($ordersIds);

        foreach ($ordersIds as $orderId) {
            if (strpos(get_post_status($orderId), 'draft') !== false) {
                continue;
            }

            $wc_order = new WC_Order($orderId);
            $address  = $wc_order->get_shipping_address_1();
            $address  .= !empty($wc_order->get_shipping_address_2()) ?
                '<br>' . $wc_order->get_shipping_address_2()
                : '';
            $address  .= '<br>' . $wc_order->get_shipping_postcode() . ' ' . $wc_order->get_shipping_city();

            $outwardLabel = $wc_order->get_meta(LpcLabelGenerationOutward::OUTWARD_PARCEL_NUMBER_META_KEY);
            $labels       = isset($trackingNumbers[$orderId]) ? $trackingNumbers[$orderId] : '';

            $data[] = [
                'data-id'             => $orderId,
                'cb'                  => '<input type="checkbox" />',
                'lpc-id'              => $this->getSeeOrderLink($orderId),
                'lpc-date'            => $wc_order->get_date_created()->date('m-d-Y'),
                'lpc-customer'        =>
                    $wc_order->get_shipping_first_name()
                    . ' ' . $wc_order->get_shipping_last_name(),
                'lpc-address'         => $address,
                'lpc-country'         => $wc_order->get_shipping_country(),
                'lpc-shipping-method' => $wc_order->get_shipping_method(),
                'lpc-woo-status'      => wc_get_order_status_name($wc_order->get_status()),
                'lpc-shipping-status' => $this->getColissimoStatus($wc_order, $outwardLabel),
                'lpc-label'           => $labels,
                'lpc-bordereau'       => $this->getBorderauDownloadLink($wc_order),
            ];
        }

        return $data;
    }

    protected function getColissimoStatus($order, $label) {
        if (!empty($label)) {
            $trackingLink = $this->unifiedTrackingApi->getTrackingPageUrlForOrder($order->get_id());

            $internalEventCode = $order->get_meta(LpcUnifiedTrackingApi::LAST_EVENT_INTERNAL_CODE_META_KEY);

            if (empty($internalEventCode)) {
                return '-';
            }

            $eventLabel = $this->colissimoStatus->getStatusInfo($internalEventCode)['label'];

            return '<a href="' . $trackingLink . '" target="_blank">' . $eventLabel . '</a>';
        }

        return '-';
    }

    protected function getBorderauDownloadLink(WC_Order $order) {
        $bordereauNumber = $order->get_meta(LpcBordereauGeneration::BORDEREAU_ID_META_KEY);
        if (!empty($bordereauNumber)) {
            $bordereauDownloadUrl = $this->bordereauDownloadAction->getUrlForBordereau($bordereauNumber);

            return <<<END_HTML
<a href="$bordereauDownloadUrl" target="_blank">$bordereauNumber</a>
END_HTML;
        }
    }

    protected function getSeeOrderLink($orderId) {
        $orderUrl = admin_url('post.php?post=' . $orderId . '&action=edit');

        return '<a href="' . $orderUrl . '">' . $orderId . '</a>';
    }

    public function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="%s[]" value="%s" />',
            self::BULK_ACTION_IDS_PARAM_NAME,
            $item['data-id']
        );
    }

    public function get_bulk_actions() {
        $actions = [
            self::BULK_BORDEREAU_GENERATION_ACTION_NAME     => __('Generate bordereau', 'wc_colissimo'),
            self::BULK_LABEL_DOWNLOAD_ACTION_NAME           => __('Download label information', 'wc_colissimo'),
            self::BULK_LABEL_GENERATION_INWARD_ACTION_NAME  => __('Generate inward labels', 'wc_colissimo'),
            self::BULK_LABEL_GENERATION_OUTWARD_ACTION_NAME => __('Generate outward labels', 'wc_colissimo'),
            self::BULK_LABEL_PRINT_INWARD_ACTION_NAME       => __('Print inward labels', 'wc_colissimo'),
            self::BULK_LABEL_PRINT_OUTWARD_ACTION_NAME      => __('Print outward labels', 'wc_colissimo'),
            self::BULK_LABEL_PRINT_ACTION_NAME              => __('Print label information', 'wc_colissimo'),
        ];

        return $actions;
    }

    public function get_sortable_columns() {
        $sortable_columns = [
            'lpc-id'              => ['id', true],
            'lpc-date'            => ['date', false],
            'lpc-customer'        => ['customer', false],
            'lpc-address'         => ['address', false],
            'lpc-country'         => ['country', false],
            'lpc-shipping-method' => ['shipping-method', false],
            'lpc-woo-status'      => ['woo-status', false],
            'lpc-shipping-status' => ['shipping-status', false],
            'lpc-bordereau'       => ['bordereau', false],
        ];

        return $sortable_columns;
    }

    protected function extra_tablenav($which) {
        if ('top' === $which) {
            $filters = $this->lpcGetFilters();

            $filtersNumbers = 0;

            array_walk(
                $filters,
                function ($filter, $key) use (&$filtersNumbers) {
                    if ('search' === $key || (count($filter) === 1 && empty($filter[0]))) {
                        $filtersNumbers += 0;
                    } else {
                        $filtersNumbers += count($filter);
                    }
                }
            );

            ?>
			<div id="lpc__orders_listing__page__more_options--toggle">
				<a id="lpc__orders_listing__page__more_options--toggle--text">
                    <?php echo __('Show filters', 'wc_colissimo'); ?>
				</a>
                <?php if ($filtersNumbers > 0) { ?>
					<span id="lpc__orders_listing__page__more_options--toggle--numbers_filters">
						<?php echo $filtersNumbers; ?>
				</span>
                <?php } ?>
			</div>

			<div id="lpc__orders_listing__page__more_options--options" style="display: none">
                <?php
                $this->countryFilters();
                $this->shipppingMethodFilters();
                $this->wooStatusFilters();
                $this->statusFilters();
                $this->labelFilters();
                ?>
				<br>
				<div id="lpc__orders_listing__page__more_options--options__bottom-actions">
                    <?php submit_button(__('Filter', 'wc_colissimo'), '', 'filter-action', false); ?>
					<a id="lpc__orders_listing__page__more_options--options__bottom-actions__reset">
                        <?php echo __('Reset', 'wc_colissimo'); ?>
					</a>
				</div>
			</div>
            <?php
        }
    }

    protected function countryFilters() {
        $displayedCountries = false === get_option('lpc_orders_filters_country') ? [''] : get_option('lpc_orders_filters_country');

        $countries = LpcOrderQueries::getLpcOrdersPostMetaList('_shipping_country');

        if (!empty($countries)) {
            ?>
			<br>
			<p class="lpc__orders_listing__page__more_options--options__title">
                <?php echo __(
                    'Country',
                    'wc_colissimo'
                ); ?></p>

			<label>
				<input type="checkbox"
					   name="order_country[]" <?php echo in_array('', $displayedCountries) ? 'checked' : ''; ?>
					   value="">
                <?php echo __('All countries', 'wc_colissimo'); ?>
			</label>
            <?php
            foreach ($countries as $oneCountry) {
                printf(
                    '<label><input type="checkbox" name="order_country[]" %1$s value="%2$s">%3$s</label>',
                    in_array($oneCountry, $displayedCountries) ? 'checked' : '',
                    esc_attr($oneCountry),
                    esc_html($oneCountry)
                );
            }
        }
    }

    protected function statusFilters() {
        $displayedStatus = false === get_option('lpc_orders_filters_status') ? [''] : get_option('lpc_orders_filters_status');

        $status = LpcOrderQueries::getLpcOrdersPostMetaList('_lpc_last_event_internal_code');

        if (!empty($status)) {
            ?>
			<br>
			<p class="lpc__orders_listing__page__more_options--options__title">
                <?php echo __(
                    'Status',
                    'wc_colissimo'
                );
                ?>
			</p>

			<label>
				<input type="checkbox" name="order_status[]" <?php echo in_array('', $displayedStatus) ? 'checked' : ''; ?> value="">
                <?php echo __('All statuses', 'wc_colissimo'); ?>
			</label>
            <?php
            foreach ($status as $oneStatusCode) {
                printf(
                    '<label><input type="checkbox" name="order_status[]" %1$s value="%2$s">%3$s</label>',
                    in_array($oneStatusCode, $displayedStatus) ? 'checked' : '',
                    esc_attr($oneStatusCode),
                    esc_html($this->colissimoStatus->getStatusInfo($oneStatusCode)['label'])
                );
            }
        }
    }

    protected function shipppingMethodFilters() {
        $displayedShippingMethods = false === get_option('lpc_orders_filters_shipping_method') ? [''] : get_option('lpc_orders_filters_shipping_method');

        $shippingMethods = LpcOrderQueries::getLpcOrdersShippingMethods();

        if (!empty($shippingMethods)) {
            ?>
			<br>
			<p class="lpc__orders_listing__page__more_options--options__title"><?php echo __('Shipping method', 'wc_colissimo'); ?></p>

			<label>
				<input type="checkbox" name="order_shipping_method[]" <?php echo in_array('', $displayedShippingMethods) ? 'checked' : ''; ?> value="">
                <?php echo __('All shipping methods', 'wc_colissimo'); ?>
			</label>
            <?php

            foreach ($shippingMethods as $oneShippingMethod) {
                printf(
                    '<label><input type="checkbox" name="order_shipping_method[]" %1$s value="%2$s">%3$s</label>',
                    in_array($oneShippingMethod, $displayedShippingMethods) ? 'checked' : '',
                    esc_attr($oneShippingMethod),
                    esc_html($oneShippingMethod)
                );
            }
        }
    }

    protected function labelFilters() {
        $displayedLabelTypes = false === get_option('lpc_orders_filters_label_type') ? [''] : get_option('lpc_orders_filters_label_type');

        $labelTypes = [
            'none'    => __('No label generated', 'wc_colissimo'),
            'outward' => __('Outward label generated', 'wc_colissimo'),
            'inward'  => __('Inward label generated', 'wc_colissimo'),
        ];

        ?>
		<br>
		<p class="lpc__orders_listing__page__more_options--options__title"><?php echo __('Labels', 'wc_colissimo'); ?></p>

		<label>
			<input type="checkbox" name="label_type[]" <?php echo in_array('', $displayedLabelTypes) ? 'checked' : ''; ?> value="">
            <?php echo __('All', 'wc_colissimo'); ?>
		</label>

        <?php
        foreach ($labelTypes as $oneLabelCode => $oneLabelType) {
            printf(
                '<label><input type="checkbox" name="label_type[]" %1$s value="%2$s">%3$s</label>',
                in_array($oneLabelCode, $displayedLabelTypes) ? 'checked' : '',
                esc_attr($oneLabelCode),
                esc_html($oneLabelType)
            );
        }
    }

    public function wooStatusFilters() {
        $displayedWooStatuses = false === get_option('lpc_orders_filters_woo_status') ? [''] : get_option('lpc_orders_filters_woo_status');

        $wooStatuses = LpcOrderQueries::getLpcOrdersWooStatuses();

        if (!empty($wooStatuses)) {
            ?>
			<br>
			<p class="lpc__orders_listing__page__more_options--options__title"><?php echo __('Order status', 'wc_colissimo'); ?></p>

			<label>
				<input type="checkbox" name="order_woo_status[]" <?php echo in_array('', $displayedWooStatuses) ? 'checked' : ''; ?> value="">
                <?php echo __('All order statuses', 'wc_colissimo'); ?>
			</label>
            <?php

            foreach ($wooStatuses as $oneWooStatus) {
                printf(
                    '<label><input type="checkbox" name="order_woo_status[]" %1$s value="%2$s">%3$s</label>',
                    in_array($oneWooStatus, $displayedWooStatuses) ? 'checked' : '',
                    esc_attr($oneWooStatus),
                    wc_get_order_status_name(esc_html($oneWooStatus))
                );
            }
        }
    }

    public function process_bulk_action() {
        if (isset($_REQUEST['_wpnonce']) && !empty($_REQUEST['_wpnonce'])) {
            $nonce  = filter_input(INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING);
            $action = 'bulk-' . $this->_args['plural'];

            if (!wp_verify_nonce($nonce, $action)) {
                wp_die(__('Access denied! (Security check failed)', 'wc_colissimo'));
            }
        } else {
            return;
        }

        $action = $this->current_action();
        $ids    = LpcHelper::getVar(self::BULK_ACTION_IDS_PARAM_NAME, [], 'array');
        if (empty($ids)) {
            // no selectionned IDs on bulk actions => nothing to do.
            return;
        }

        switch ($action) {
            case self::BULK_BORDEREAU_GENERATION_ACTION_NAME:
                $this->bulkBordereauGeneration($ids);
                break;

            case self::BULK_LABEL_DOWNLOAD_ACTION_NAME:
                $this->bulkLabelDownload($ids);
                break;

            case self::BULK_LABEL_GENERATION_OUTWARD_ACTION_NAME:
                $this->bulkLabelGeneration($this->labelGenerationOutward, $ids);
                break;

            case self::BULK_LABEL_GENERATION_INWARD_ACTION_NAME:
                $this->bulkLabelGeneration($this->labelGenerationInward, $ids);
                break;

            case self::BULK_LABEL_PRINT_INWARD_ACTION_NAME:
                $this->bulkLabelPrint($ids, LpcInwardLabelDb::LABEL_TYPE_INWARD);
                break;

            case self::BULK_LABEL_PRINT_OUTWARD_ACTION_NAME:
                $this->bulkLabelPrint($ids, LpcOutwardLabelDb::LABEL_TYPE_OUTWARD);
                break;

            case self::BULK_LABEL_PRINT_ACTION_NAME:
                $this->bulkLabelPrint($ids, LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD);
                break;
        }
    }

    protected function getOrdersByIds(array $ids) {
        return array_map(
            function ($id) {
                return new WC_Order($id);
            },
            $ids
        );
    }

    protected function bulkBordereauGeneration(array $ids) {
        $orders = $this->getOrdersByIds($ids);

        $bordereau = $this->bordereauGeneration->generate($orders);
        /** Special handling of the generation result :
         *  - if its empty, certainly because multiple bordereaux were generated (remembering that one
         *    bordereau can only have 50 tracking numbers), we prefer not to download any of the generate
         *    bordereau, and thus only refresh/redict to the same listing page,
         *  - else, i.e. if its *not* empty, it means that only one bordereau was generated, as a convenience
         *    for the user, we directly initiate a download of it.
         */
        if (!empty($bordereau)) {
            $bordereauId                  = $bordereau->bordereauHeader->bordereauNumber;
            $bordereauGenerationActionUrl = $this->bordereauDownloadAction->getUrlForBordereau($bordereauId);

            $i18n = __('Click here to download your created bordereau', 'wc_colissimo');

            echo <<<END_DOWNLOAD_LINK
<div class="updated"><p><a href="$bordereauGenerationActionUrl">$i18n</a></p></div>
END_DOWNLOAD_LINK;
        } else {
            $requestURI = '';
            if (is_null(filter_input(INPUT_SERVER, 'REQUEST_URI'))) {
                if (isset($_SERVER['REQUEST_URI'])) {
                    $requestURI = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
                }
            } else {
                $requestURI = wp_unslash(filter_input(INPUT_SERVER, 'REQUEST_URI'));
            }

            wp_redirect(
                remove_query_arg(
                    ['_wp_http_referer', '_wpnonce', self::BULK_ACTION_IDS_PARAM_NAME, 'action', 'action2'],
                    $requestURI
                )
            );
            exit;
        }
    }

    protected function bulkLabelDownload(array $ids) {
        $trackingNumbers = $this->labelQueries->getTrackingNumbersForOrdersId($ids);

        $labelDownloadActionUrl = $this->labelPackagerDownloadAction->getUrlForTrackingNumbers($trackingNumbers);
        $i18n                   = __('Click here to download your created label package', 'wc_colissimo');

        echo <<<END_DOWNLOAD_LINK
<div class="updated"><p><a href="$labelDownloadActionUrl">$i18n</a></p></div>
END_DOWNLOAD_LINK;
    }

    protected function bulkLabelGeneration($generator, array $ids) {
        $orders = $this->getOrdersByIds($ids);

        try {
            foreach ($orders as $order) {
                $generator->generate($order);
            }

            $requestURI = '';
            if (is_null(filter_input(INPUT_SERVER, 'REQUEST_URI'))) {
                if (isset($_SERVER['REQUEST_URI'])) {
                    $requestURI = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
                }
            } else {
                $requestURI = wp_unslash(filter_input(INPUT_SERVER, 'REQUEST_URI'));
            }

            wp_redirect(
                remove_query_arg(
                    ['_wp_http_referer', '_wpnonce', self::BULK_ACTION_IDS_PARAM_NAME, 'action', 'action2'],
                    $requestURI
                )
            );
            exit;
        } catch (Exception $e) {
            add_action(
                'admin_notice',
                function () use ($e) {
                    LpcHelper::displayNoticeException($e);
                }
            );
        }
    }

    public function bulkLabelPrint($ids, $labelType = LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD) {
        $trackingNumbers = $this->labelQueries->getTrackingNumbersForOrdersId($ids, $labelType);

        $stringTrackingNumbers = implode(',', $trackingNumbers);

        $needInvoice = false;

        if (LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD === $labelType) {
            $needInvoice = true;
        }

        $labelPrintActionUrl = $this->labelPrintAction->getUrlForTrackingNumbers($trackingNumbers, $needInvoice);

        echo <<<END_PRINT_SCRIPT
<script type="text/javascript">
        jQuery(function ($) {
            $(document).ready(function(){
                let infos = {
                    'pdfUrl': '$labelPrintActionUrl',
                    'labelType': '$labelType',
                    'trackingNumbers': '$stringTrackingNumbers'
                };
                
                lpc_print_labels(infos);
            });
        });
</script>
END_PRINT_SCRIPT;
    }

    public function displayHeaders() {
        $title                    = __('Colissimo Orders', 'wc_colissimo');
        $buttonUpdateStatusLabel  = __('Update Colissimo statuses', 'wc_colissimo');
        $buttonUpdateStatusAction = $this->updateStatuses->getUpdateAllStatusesUrl();

        echo <<<HEADERS
<h1 class="wp-heading-inline">$title</h1>
<a href="$buttonUpdateStatusAction" class="page-title-action">$buttonUpdateStatusLabel</a>
<hr class="wp-header-end">
HEADERS;
    }

    protected function lpcGetFilters() {
        return [
            'country'         =>
                false === get_option('lpc_orders_filters_country') ? [''] : get_option('lpc_orders_filters_country'),
            'shipping_method' => false === get_option('lpc_orders_filters_shipping_method') ?
                [''] : get_option('lpc_orders_filters_shipping_method'),
            'status'          => false === get_option('lpc_orders_filters_status') ?
                [''] : get_option('lpc_orders_filters_status'),
            'label_type'      => false === get_option('lpc_orders_filters_label_type') ?
                [''] : get_option('lpc_orders_filters_label_type'),
            'woo_status'      => false === get_option('lpc_orders_filters_woo_status') ?
                [''] : get_option('lpc_orders_filters_woo_status'),
            'search'          => isset($_REQUEST['s']) ?
                esc_attr(sanitize_text_field(wp_unslash($_REQUEST['s']))) : '',
        ];
    }

    protected function getTrackingNumbersFormated($ordersId = []) {
        $trackingNumbersByOrders         = [];
        $renderedTrackingNumbersByOrders = [];
        $labelFormatByTrackingNumber     = [];

        $this->labelQueries->getTrackingNumbersByOrdersId($trackingNumbersByOrders, $labelFormatByTrackingNumber, $ordersId);

        foreach ($trackingNumbersByOrders as $oneOrderId => $oneOrder) {
            $renderedTrackingNumbersByOrders[$oneOrderId] = '<div class="lpc__orders_listing__tracking-numbers">';
            foreach ($oneOrder as $outLabel => $inLabel) {
                if ('no_outward' !== $outLabel) {
                    $format = $labelFormatByTrackingNumber[$outLabel];

                    $renderedTrackingNumbersByOrders[$oneOrderId] .=
                        '<span class="lpc__orders_listing__tracking-number">' .
                        '<span class="lpc__orders_listing__tracking_number--outward">' . $outLabel . '</span>' .
                        $this->labelQueries->getOutwardLabelsActionsIcons($outLabel, $format, LpcLabelQueries::REDIRECTION_COLISSIMO_ORDERS_LISTING)
                        . '</span><br>';
                }

                foreach ($inLabel as $oneInLabel) {
                    $format = $labelFormatByTrackingNumber[$oneInLabel];

                    $renderedTrackingNumbersByOrders[$oneOrderId] .=
                        '<span class="lpc__orders_listing__tracking-number">' .
                        '<span class="dashicons dashicons-undo lpc__orders_listing__inward_logo"></span>'
                        . '<span class="lpc__orders_listing__tracking_number--inward">' . $oneInLabel . '</span>' .
                        $this->labelQueries->getInwardLabelsActionsIcons($oneInLabel, $format, LpcLabelQueries::REDIRECTION_COLISSIMO_ORDERS_LISTING)
                        . '</span><br>';
                }
                $renderedTrackingNumbersByOrders[$oneOrderId] .= '<br>';
            }
            $renderedTrackingNumbersByOrders[$oneOrderId] .= '</div>';
        }

        return $renderedTrackingNumbersByOrders;
    }
}
