<?php

require_once LPC_INCLUDES . 'pick_up' . DS . 'lpc_pick_up_widget_api.php';
require_once LPC_INCLUDES . 'lpc_modal.php';

class LpcAdminPickupWidget extends LpcComponent {
    const BASE_URL = 'https://ws.colissimo.fr/';
    const WEB_JS_URL = self::BASE_URL . 'widget-point-retrait/resources/js/jquery.plugin.colissimo.js';

    protected $pickUpWidgetApi;
    protected $lpcCapabilitiesPerCountry;

    public function __construct(
        LpcPickUpWidgetApi $pickUpWidgetApi = null,
        LpcCapabilitiesPerCountry $lpcCapabilitiesPerCountry = null
    ) {
        $this->pickUpWidgetApi           = LpcRegister::get('pickupWidgetApi', $pickUpWidgetApi);
        $this->lpcCapabilitiesPerCountry = LpcRegister::get('capabilitiesPerCountry', $lpcCapabilitiesPerCountry);
    }

    public function getDependencies() {
        return ['pickupWidgetApi', 'capabilitiesPerCountry'];
    }

    public function init() {
        add_action('current_screen',
            function ($currentScreen) {
                if (is_admin() && 'post' === $currentScreen->base && 'shop_order' === $currentScreen->post_type) {
                    wp_register_script('lpc_widgets_web_js_url', self::WEB_JS_URL, ['jquery'], '0.1', true);
                    wp_localize_script('lpc_widgets_web_js_url', 'lpcPickUpSelection', []);

                    LpcHelper::enqueueScript(
                        'lpc_widget',
                        plugins_url('/js/pickup/admin_pickup_widget.js', LPC_ADMIN . 'init.php'),
                        null,
                        ['jquery-ui-autocomplete', 'lpc_widgets_web_js_url']
                    );

                    LpcHelper::enqueueScript(
                        'wc-backbone-modal',
                        null,
                        plugins_url('woocommerce/assets/js/admin/backbone-modal.min.js'),
                        ['wp-backbone']
                    ); // we can't use module modale.js here, because of the ajax refreshes

                    LpcHelper::enqueueStyle('lpc_pickup_widget', plugins_url('/css/pickup/widget.css', LPC_ADMIN . 'init.php'));
                }
            }
        );
    }

    public function addWidget(WC_Order $order) {
        $availableCountries = $this->getWidgetListCountry();
        if (empty($availableCountries)) {
            $availableCountries = ['FR'];
        }

        $args = [];

        $args['widgetInfo'] = wp_json_encode(
            [
                'ceCountryList'     => implode(',', $availableCountries),
                'ceLang'            => defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'FR',
                'ceAddress'         => !empty($order->get_shipping_address_1()) ? $order->get_shipping_address_1() : '',
                'ceZipCode'         => !empty($order->get_shipping_postcode()) ? $order->get_shipping_postcode() : '',
                'ceTown'            => !empty($order->get_shipping_city()) ? $order->get_shipping_city() : '',
                'ceCountry'         => !empty($order->get_shipping_country()) ? $order->get_shipping_country() : '',
                'URLColissimo'      => self::BASE_URL,
                'token'             => $this->pickUpWidgetApi->authenticate(),
                'dyPreparationTime' => LpcHelper::get_option('lpc_preparation_time', 1),
            ]
        );

        $args['lpcAddressTextColor'] = null;
        $args['$lpcListTextColor']   = null;
        $args['$lpcWidgetFont']      = null;
        if (LpcHelper::get_option('lpc_prCustomizeWidget', 'no') == 'yes') {
            $args['lpcAddressTextColor'] = LpcHelper::get_option('lpc_prAddressTextColor', null);
            $args['lpcListTextColor']    = LpcHelper::get_option('lpc_prListTextColor', null);

            $fontValue = LpcHelper::get_option('lpc_prDisplayFont', null);

            $fontNames = [
                'georgia'       => 'Georgia, serif',
                'palatino'      => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
                'times'         => '"Times New Roman", Times, serif',
                'arial'         => 'Arial, Helvetica, sans-serif',
                'arialblack'    => '"Arial Black", Gadget, sans-serif',
                'comic'         => '"Comic Sans MS", cursive, sans-serif',
                'impact'        => 'Impact, Charcoal, sans-serif',
                'lucida'        => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
                'tahoma'        => 'Tahoma, Geneva, sans-serif',
                'trebuchet'     => '"Trebuchet MS", Helvetica, sans-serif',
                'verdana'       => 'Verdana, Geneva, sans-serif',
                'courier'       => '"Courier New", Courier, monospace',
                'lucidaconsole' => '"Lucida Console", Monaco, monospace',
            ];

            $args['lpcWidgetFont'] = $fontNames[$fontValue];
        }

        $modalContent = '<div id="lpc_widget_container"></div>';

        $args['modal'] = new LpcModal(
            $modalContent, __('Choose a PickUp point', 'wc_colissimo'),
            'lpc_pick_up_widget_container'
        );

        return LpcHelper::renderPartial('pickup' . DS . 'widget.php', $args);
    }

    /**
     * Get list of enabled countries for relay method
     *
     * @return array
     */
    public function getWidgetListCountry() {
        // Get theoric countries available for relay method
        $countriesOfMethod = $this->lpcCapabilitiesPerCountry->getCountriesForMethod(LpcRelay::ID);

        // Get zones where relay method is enabled in configuration
        $allZones               = WC_Shipping_Zones::get_zones();
        $zonesWithMethodEnabled = [];
        foreach ($allZones as $oneZone) {
            foreach ($oneZone['shipping_methods'] as $oneMethod) {
                if (LpcRelay::ID === $oneMethod->id && 'yes' === $oneMethod->enabled) {
                    $zonesWithMethodEnabled[$oneZone['id']] = 1;
                    break;
                }
            }
        }
        $zoneIds = array_keys($zonesWithMethodEnabled);

        // Get country codes from both
        $countries = [];
        foreach ($zoneIds as $oneZone) {
            $currentZone = new WC_Shipping_Zone($oneZone);
            $zoneLoc     = $currentZone->get_zone_locations();
            foreach ($zoneLoc as $oneLoc) {
                if ('country' === $oneLoc->type && in_array($oneLoc->code, $countriesOfMethod)) {
                    $countries[] = $oneLoc->code;
                }
            }
        }

        return $countries;
    }
}
