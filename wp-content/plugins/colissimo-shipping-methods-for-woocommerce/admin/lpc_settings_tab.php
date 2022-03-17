<?php

defined('ABSPATH') || die('Restricted Access');

require_once LPC_INCLUDES . 'lpc_modal.php';

/**
 * Class Lpc_Settings_Tab to handle Colissimo tab in Woocommerce settings
 */
class LpcSettingsTab extends LpcComponent {
    const LPC_SETTINGS_TAB_ID = 'lpc';

    /**
     * @var array Options available
     */
    protected $configOptions;

    protected $seeLogModal;

    public function init() {
        // Add configuration tab in Woocommerce
        add_filter('woocommerce_settings_tabs_array', [$this, 'configurationTab'], 70);
        // Add configuration tab content
        add_action('woocommerce_settings_tabs_' . self::LPC_SETTINGS_TAB_ID, [$this, 'settingsPage']);
        // Save settings page
        add_action('woocommerce_update_options_' . self::LPC_SETTINGS_TAB_ID, [$this, 'saveLpcSettings']);

        // Define the log modal field
        $this->initSeeLog();

        $this->initMultiSelectOrderStatus();

        $this->initSelectOrderStatusOnLabelGenerated();

        $this->initSelectOrderStatusOnPackageDelivered();

        $this->initSelectOrderStatusOnBordereauGenerated();

        $this->initDisplayNumberInputWithWeightUnit();

        $this->initOriginAddress();
    }

    protected function initSeeLog() {
        $modalContent      = '<pre>' . LpcLogger::get_logs() . '</pre>';
        $this->seeLogModal = new LpcModal($modalContent, 'Colissimo logs', 'lpc-debug-log');
        add_action('woocommerce_admin_field_seelog', [$this, 'displayDebugButton']);
    }

    protected function initMultiSelectOrderStatus() {
        add_action('woocommerce_admin_field_multiselectorderstatus', [$this, 'displayMultiSelectOrderStatus']);
    }

    protected function initSelectOrderStatusOnLabelGenerated() {
        add_action(
            'woocommerce_admin_field_selectorderstatusonlabelgenerated',
            [$this, 'displaySelectOrderStatusOnLabelGenerated']
        );
    }

    protected function initSelectOrderStatusOnPackageDelivered() {
        add_action(
            'woocommerce_admin_field_selectorderstatusonpackagedelivered',
            [$this, 'displaySelectOrderStatusOnPackageDelivered']
        );
    }

    protected function initSelectOrderStatusOnBordereauGenerated() {
        add_action(
            'woocommerce_admin_field_selectorderstatusonbordereaugenerated',
            [$this, 'displaySelectOrderStatusOnBordereauGenerated']
        );
    }

    protected function initDisplayNumberInputWithWeightUnit() {
        add_action(
            'woocommerce_admin_field_numberinputwithweightunit',
            [$this, 'displayNumberInputWithWeightUnit']
        );
    }

    protected function initOriginAddress() {
        add_action(
            'woocommerce_admin_field_originaddress',
            [$this, 'originAddress']
        );
    }

    /**
     * Define the "seelogs" field type for the main configuration page
     *
     * @param $field object containing parameters defined in the config_options.json
     */
    public function displayDebugButton($field) {
        $modal = $this->seeLogModal;
        include LPC_FOLDER . 'admin' . DS . 'partials' . DS . 'settings' . DS . 'debug.php';
    }

    public function displayMultiSelectOrderStatus() {
        $args                    = [];
        $args['id_and_name']     = 'lpc_generate_label_on';
        $args['label']           = 'Generate label on';
        $args['values']          = array_merge(['disable' => __('Disable', 'wc_colissimo')], wc_get_order_statuses());
        $args['selected_values'] = get_option($args['id_and_name']);
        $args['multiple']        = true;
        echo LpcHelper::renderPartial('settings' . DS . 'select_field.php', $args);
    }

    public function displaySelectOrderStatusOnLabelGenerated() {
        $args                    = [];
        $args['id_and_name']     = 'lpc_order_status_on_label_generated';
        $args['label']           = 'Order status once label is generated';
        $args['values']          = array_merge(
            ['unchanged_order_status' => __('Keep order status as it is', 'wc_colissimo')],
            wc_get_order_statuses()
        );
        $args['selected_values'] = get_option($args['id_and_name']);
        echo LpcHelper::renderPartial('settings' . DS . 'select_field.php', $args);
    }

    public function displaySelectOrderStatusOnPackageDelivered() {
        $args                    = [];
        $args['id_and_name']     = 'lpc_order_status_on_package_delivered';
        $args['label']           = 'Order status once the package is delivered';
        $args['values']          = wc_get_order_statuses();
        $args['selected_values'] = get_option($args['id_and_name']);
        echo LpcHelper::renderPartial('settings' . DS . 'select_field.php', $args);
    }

    public function displaySelectOrderStatusOnBordereauGenerated() {
        $args                    = [];
        $args['id_and_name']     = 'lpc_order_status_on_bordereau_generated';
        $args['label']           = 'Order status once bordereau is generated';
        $args['values']          = array_merge(
            ['unchanged_order_status' => __('Keep order status as it is', 'wc_colissimo')],
            wc_get_order_statuses()
        );
        $args['selected_values'] = get_option($args['id_and_name']);
        echo LpcHelper::renderPartial('settings' . DS . 'select_field.php', $args);
    }

    public function displayNumberInputWithWeightUnit() {
        $args                = [];
        $args['id_and_name'] = 'lpc_packaging_weight';
        $args['label']       = 'Packaging weight (%s)';
        $args['value']       = get_option($args['id_and_name']);
        $args['desc']        = 'The packaging weight will be added to the products weight on label generation.';
        echo LpcHelper::renderPartial('settings' . DS . 'number_input_weight.php', $args);
    }

    public function originAddress($defaultArgs) {
        $args = [];

        if ('lpc_origin_address_country' == $defaultArgs['id']) {
            $countries_obj = new WC_Countries();
            $countries     = $countries_obj->__get('countries');

            $countriesCode = array_merge(LpcCapabilitiesPerCountry::DOM1_COUNTRIES_CODE, LpcCapabilitiesPerCountry::FRANCE_COUNTRIES_CODE);

            $args['values'][''] = '---';

            foreach ($countriesCode as $countryCode) {
                $args['values'][$countryCode] = $countries[$countryCode];
            }

            $value = LpcHelper::get_option('lpc_origin_address_country', '');
            if (empty($value)) {
                $value = '';
            }

            $args['id_and_name']     = 'lpc_origin_address_country';
            $args['label']           = $defaultArgs['title'];
            $args['desc']            = $defaultArgs['desc'];
            $args['selected_values'] = $value;

            echo LpcHelper::renderPartial('settings' . DS . 'select_field.php', $args);

            return;
        }

        $args['id_and_name'] = $defaultArgs['id'];
        $args['label']       = $defaultArgs['title'];
        $args['desc']        = $defaultArgs['desc'];

        $options = [
            'lpc_origin_address_line_1'  => 'woocommerce_store_address',
            'lpc_origin_address_line_2'  => 'woocommerce_store_address_2',
            'lpc_origin_address_city'    => 'woocommerce_store_city',
            'lpc_origin_address_zipcode' => 'woocommerce_store_postcode',
        ];

        foreach ($options as $lpcOption => $wcOption) {
            if ($lpcOption != $args['id_and_name']) {
                continue;
            }

            $option = LpcHelper::get_option($lpcOption, '');

            $args['value'] = $option;
        }

        echo LpcHelper::renderPartial('settings' . DS . 'input_text.php', $args);
    }

    /**
     * Build tab
     *
     * @param $tab
     *
     * @return mixed
     */
    public function configurationTab($tab) {
        $tab[self::LPC_SETTINGS_TAB_ID] = 'Colissimo Officiel';

        return $tab;
    }

    /**
     * Content of the configuration page
     */
    public function settingsPage() {
        if (empty($this->configOptions)) {
            $this->initConfigOptions();
        }

        WC_Admin_Settings::output_fields($this->configOptions);
    }

    /**
     * Save using Woocomerce default method
     */
    public function saveLpcSettings() {
        if (empty($this->configOptions)) {
            $this->initConfigOptions();
        }

        try {
            WC_Admin_Settings::save_fields($this->configOptions);
        } catch (Exception $exc) {
            LpcLogger::error("Can't save field setting.", $this->configOp);
        }
    }

    /**
     * Initialize configuration options from resource file
     */
    protected function initConfigOptions() {
        $configStructure = file_get_contents(LPC_RESOURCE_FOLDER . LpcHelper::CONFIG_FILE);
        $tempConfig      = json_decode($configStructure, true);
        foreach ($tempConfig as &$oneField) {
            if (!empty($oneField['title'])) {
                $oneField['title'] = __($oneField['title'], 'wc_colissimo');
            }

            if (!empty($oneField['desc'])) {
                $oneField['desc'] = __($oneField['desc'], 'wc_colissimo');
            }

            if (!empty($oneField['options'])) {
                foreach ($oneField['options'] as &$oneOption) {
                    $oneOption = __($oneOption, 'wc_colissimo');
                }
            }
        }

        $this->configOptions = $tempConfig;
    }
}
