<?php
/**
 * Default Chronopost product object
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Chronopost
 * @subpackage Chronopost/includes
 * @author     Adexos <contact@adexos.fr>
 */

function chronopost_product_init()
{
    if (! class_exists('WC_Chronopost_Product')) {
        class WC_Chronopost_Product extends WC_Shipping_Method
        {
	        protected $admin_notice;
	        private $chrono_settings;
            public $id;
            public $method_description;
            public $title;
            public $loader;
            public $pretty_title;
            public $max_product_weight = 30;
            public $product_code;
            public $product_code_bal = false;
            public $product_code_str = false;
            public $product_code_bal_str = false;
            public $product_code_return = '01';
            public $product_code_return_service = '226';
            public $tracking_url = 'https://www.chronopost.fr/fr/chrono_suivi_search?listeNumerosLT={tracking_number}';
            public $form_fields;

            /**
              * Constructor for your shipping class
              *
              * @access public
              * @return void
              */
      
            public function __construct()
            {
                $this->loader = new Chronopost_Loader();
                
                $this->shipping_method_setting();

                $this->used_product_code = chrono_get_option('enable', 'bal_option') == 'yes' && $this->product_code_bal !== false ? $this->product_code_bal : $this->product_code;

                $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled

                $this->option_key  		  = $this->id.'_table_rates';
                $this->options			  = array();

                $this->get_options();
        
                $this->chrono_settings = get_option('chronopost_settings');

                $this->init();
            }

	        public function print_admin_notice()
	        {
		        echo chrono_notice($this->admin_notice, 'error');
	        }

	        public function print_admin_success()
	        {
		        echo chrono_notice($this->admin_notice, 'success');
	        }

            public function shipping_method_setting()
            {
                $this->id                 = 'chronopost_product'; // Id for your shipping method. Should be uunique.
                $this->title       = __('Chronopost Product', 'chronopost');  // Title shown in admin
                $this->pretty_title       = __('Chronopost Product', 'chronopost');  // Title shown in admin
                $this->method_title       = __( 'Chronopost', 'woocommerce' );
                $this->method_description = ''; // Description shown in admin
                $this->title              = "Chronopost Product"; // This can be added as an setting but for this example its forced.
            }
      
            private function get_options()
            {
                if (get_option($this->option_key) === false) {
                    $csv = plugin_dir_path(dirname(__FILE__)) . 'csv/' . $this->id . '.csv';
                    if (file_exists($csv)) {
                        $csv = fopen($csv, 'r');

                        $country_array = array();
                        $countries = array();
                        $min = array();
                        $max = array();
                        $shipping = array();

                        $i = 0;
                        while (($row = fgetcsv($csv, 0, ';')) !== false) {
                            // Extract the parameters from the current row.
                            list(
                                    $countries, $min, $max, $shipping) = $row;
                            
                            $country_arr = explode(',', $countries);
                            $arr_zone_names = array();

                            foreach ($country_arr as $c) {
                                $arr_zone_names[] = WC()->countries->countries[ $c ];
                            }

                            $zone_name = implode(', ', $arr_zone_names);
                            
                            if (!array_key_exists($zone_name, $this->options)) {
                                $this->options[ $zone_name ] = array();
                                $this->options[ $zone_name ]['countries'] = $country_arr;
                                $this->options[ $zone_name ]['rates'] = array();
                            }
                            $this->options[ $zone_name ]['min'][] = $min;
                            $this->options[ $zone_name ]['max'][] = $max;
                            $this->options[ $zone_name ]['shipping'][] = $shipping;
                            $this->options[ $zone_name ]['rates'][] = array(
                                'min' => $min,
                                'max' => $max,
                                'shipping' => $shipping
                            );
                        }
                    }
                } else {
                    $this->options = array_filter((array) get_option($this->option_key));
                }
            }

            /**
              * Init your settings
              *
              * @access public
              * @return void
              */
            public function init()
            {
                // Load the settings API
                $this->get_default_form_fields();
                $this->extra_form_fields();
                $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                $this->init_settings(); // This is part of the settings API. Loads settings you previously init.
                $this->weight_unit = chrono_get_weight_unit();

                $this->create_select_arrays();
                
                if (!is_admin()) {
                    $this->load_frontend_hooks();
                }

                // Save settings in admin if you have any defined
                add_action('woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ));
        
                //And save our options
                add_action('woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_custom_settings' ));

                $this->custom_actions();
            }
            
            public function load_frontend_hooks()
            {
                // silence is golden
            }

            public function custom_actions()
            {
                // silence is golden still
            }

            public function extra_form_fields()
            {
            }

	        /**
	         * @param null|WC_Order $order
	         *
	         * @return array
	         */
            public function getContractInfos($order = null)
            {
	            $selected_contract = false;
                if ($order !== null && $order instanceof WC_Order) {
	                $selected_contract = get_post_meta($order->get_id(), '_use_contract', true);
                }
	            if (!$selected_contract && isset($this->settings['contract'])) {
		            $selected_contract = $this->settings['contract'];
	            }
	            // Last chance
	            if (!$selected_contract) {
		            $selected_contract = $this->form_fields["contract"]["default"];
	            }

	            return chrono_get_contract_infos($selected_contract);
            }

            public function addMargeToQuickcost($quickcost_val, $carrierCode = '', $firstPassage = true)
            {
                if ($carrierCode) {
                    $quickcostMarge =  $this->settings['quickcost_marge'];
                    $quickcostMargeType = $this->settings['quickcost_marge_type'];

                    if ($quickcostMarge) {
                        if ($quickcostMargeType == 'amount') {
                            $quickcost_val += $quickcostMarge;
                        } elseif ($quickcostMargeType == 'prcent') {
                            $quickcost_val += $quickcost_val * $quickcostMarge / 100;
                        }
                    }
                }
                return $quickcost_val;
            }

            public function calculate_shipping($package = array())
            {
                $rate = $this->get_shipping_rate($package);
                $this->add_rate($rate);
            }

            /**
                * calculate_shipping function.
                *
                * @access public
                * @param mixed $package
                * @return mixed
                */
            public function get_shipping_rate($package = array())
            {
                if ($this->settings['enabled'] != 'yes') {
                    return false;
                }

                $cost = false;

                $ws = new Chronopost_Webservice();

                if ($package['destination']['postcode'] == '') {
                    return false;
                }

                $dest_country = $package['destination']['country'];

                $this->isAllowed = $ws->getMethodIsAllowed($this, $package);

                if (!$this->isAllowed) {
                    return false;
                }

                //what is the tax status
                $taxes = $this->settings['tax_status'] == 'none' ? false : '';
            
                $cartWeight = WC()->cart->cart_contents_weight;

                //to get arrival code
                if (chrono_get_weight_unit() == 'g') {
                    $cartWeight = $cartWeight / 1000; /* conversion g => kg */
                }


                $items = WC()->cart->get_cart();
            
                // if one of an item exceed 30 kg (by default), skip chrono methods
                foreach ($items as $item => $values) {
                    $product_weight = (float)$values['data']->get_weight();
                    if (chrono_get_weight_unit() == 'g') {
                        $product_weight = $product_weight / 1000;
                    }

                    if ($product_weight > $this->max_product_weight) {
                        return false;
                    }
                }

                if ($this->settings['quickcost_enable'] == 'yes') {
                    $supplementCorse = 0; // Supplement pour la Corse
                    $arrCode = $package['destination']['postcode'];

                    if ($this->id == 'chronoexpress' || $this->id == 'chronopostcclassic') {
                        $arrCode = $dest_country;
                    }

	                $contract = $this->getContractInfos();
                    $quickCost = array(
                        'accountNumber' => $contract['number'],
                        'password' => $contract['password'],
                        'depCode' => chrono_get_option('zipcode', 'shipper'),
                        'arrCode' => $arrCode,
                        'weight' => ($cartWeight != 0) ? $cartWeight : 1,
                        'productCode' => $this->used_product_code,
                        'type' => 'M'
                    );
                
                    if ($quickCostValues = $ws->getQuickcost($quickCost, $this->settings['quickcost_url'])) {
                        if ($quickCostValues->errorCode == 0) {
                            $quickcost_val = (float) $quickCostValues->amountTTC;

                            /* Ajout marge au quickcost */
                            if ($quickcost_val !== false) {
                                $cost = $this->addMargeToQuickcost($quickcost_val, $this->id);
                            }
                        } else {
                            //wc_add_notice( $quickCostValues->errorMessage, 'error' );
                            // @TODO situation si quickcost ne retourne aucune valeur
                            return;
                        }
                    }
                }
                else {
                    $supplementCorse = chrono_get_option('amount', 'corsica_supplement');
                }

                // no quickcost value or no activated quickcost
                if ($cost === false) {
                
                    // get the associated rate for the country
                    $rates = $this->get_rates_for_country($dest_country);
                
                    if ($rates == null) {
                        //no rate available for the dest country
                        return;
                    }

                    // get the associated rate by weight
                    $cost = $this->find_matching_rate($cartWeight + 0.1, $rates);
                }
            
                if ($cost === null || $cost === false) {
                    return;
                }

                if (is_numeric($this->settings['handling_fee'])) {
                    $cost += $this->settings['handling_fee'];
                }
            
                if (is_numeric($this->settings['application_fee'])) {
                    $cost += $this->settings['application_fee'];
                }

                // Add corsica supplement
                if ($package['destination']['country'] === 'FR' && (int)$package['destination']['postcode'] >= 20000 && (int)$package['destination']['postcode'] < 21000) {
                    $cost += $supplementCorse;
                }

                // Free shipping feature
                if(isset($this->settings['free_shipping_enable']) && $this->settings['free_shipping_enable'] === 'yes' && (float)$package['cart_subtotal'] >= (float)$this->settings['free_shipping_minimum_amount']) {
                    $cost = false;
                }

                $rate = array(
                    'id' => $this->id,
                    'label' => $this->settings['title'] . (!$cost ? ': ' . __('Free', 'chronopost') : ''),
                    'cost' => $cost,
                    'taxes' => $taxes,
                    'calc_tax' => 'per_order'
                );

                return $rate;
            }
            
            public function get_rates_for_country($country)
            {
                //Find matching rate through options
                $ret = array();
                foreach ($this->options as $rate) {
                    if (in_array($country, $rate['countries'])) {
                        $ret[] =  $rate;
                    }
                }
            
                //if something found, return it, otherwise return null.
                return count($ret) > 0 ? $ret : null; 
            }
        
            //Find the matching rate
            public function find_matching_rate($value, $shipping_zones)
            {
                foreach ($shipping_zones as $shipping_zone) {
                    //get max and min rate for each zone
                    for ($i=0; $i<count($shipping_zone['max']); $i++) {
                        // infinity case
                        if ($shipping_zone['max'][$i] == '*') {
                            if ($value >= $shipping_zone['min'][$i]) {
                                return $shipping_zone['shipping'][$i];
                            }
                        } else {
                            if ($value >= $shipping_zone['min'][$i] && $value <= $shipping_zone['max'][$i]) {
                                return $shipping_zone['shipping'][$i];
                            }
                        }
                    }
                    // nothing found, return null
                    return null;
                }
            }

            public function get_default_form_fields()
            {
                $this->form_fields = array(
                'enabled' => array(
                    'title' 		=> __('Enable?', 'chronopost'),
                    'type' 			=> 'checkbox',
                    'label' 		=> __('Enable the shipping method', 'chronopost'),
                    'default' 		=> 'no'
                ),
                'contract' => array(
	                'title' 		=> __('Contract', 'chronopost'),
	                'type' 			=> 'select',
	                'default'       => $this->get_default_contrat(),
	                'options'       => $this->get_contracts_list(),
                ),
                'title' => array(
                    'title' 		=> __('Checkout Title', 'chronopost'),
                    'description' 		=> __('This title appear during the checkout', 'chronopost'),
                    'type' 			=> 'text',
                    'default' 		=> __($this->pretty_title, 'chronopost'),
                    'desc_tip'     => true
                ),
                'quickcost_enable' => array(
                    'title' 		=> __('Activate Quickcost', 'chronopost'),
                    'type' 			=> 'checkbox',
                    'label' 		=> __('Automatically calculate the shipping cost with Quickcost', 'chronopost'),
                    'default' 		=> 'no',
                    'description' 		=> __('Quickcost will calculate the cost of an item, depending on the rates negociated with Chronopost. This option replaces the use of the fee schedule.', 'chronopost'),
                    'desc_tip'     => true
                ),
                'quickcost_url' => array(
                    'title' 		=> __('Quickcost URL', 'chronopost'),
                    'type' 			=> 'text',
                    'default' 		=> 'https://www.chronopost.fr/quickcost-cxf/QuickcostServiceWS?wsdl'
                ),
                'quickcost_marge' => array(
                    'title' 		=> __('Value to add to Quickcost', 'chronopost'),
                    'type' 			=> 'number',
                    'default' 		=> '0',
                    'class'     => 'small-text'
                ),
                'quickcost_marge_type' => array(
                    'title' 		=> __('Type of marge', 'chronopost'),
                    'type' 			=> 'select',
                    'default' 		=> 'amount',
                    'options'		=> array(
                        'amount' 	=> __('Amount (€)', 'chronopost'),
                        'prcent' 		=> __('Percentage (%)', 'chronopost'),
                    ),
                    'custom_attributes' => array(
                        'step' => 'any'
                    )
                ),
                'application_fee' => array(
                    'title' 		=> __('Application fee', 'chronopost'),
                    'type' 			=> 'number',
                    'default' 		=> 0,
                    'class'     => 'small-text',
                    'custom_attributes' => array(
                        'step' => 'any'
                    )
                ),
                'handling_fee' => array(
                    'title' 		=> __('Handling fee', 'chronopost'),
                    'type' 			=> 'number',
                    'default' 		=> 0,
                    'class'     => 'small-text',
                    'custom_attributes' => array(
                        'step' => 'any'
                    )
                ),
                'tracking_url' => array(
                    'title' 		=> __('Tracking URL', 'chronopost'),
                    'type' 			=> 'text',
                    'default' 		=> $this->tracking_url,
                ),
                'deliver_on_saturday' => array(
                    'title' 		=> __('Deliver on Saturday?', 'chronopost'),
                    'type' 			=> 'select',
                    'default' 		=> 'no',
                    'options'		=> array(
                        'no' 	=> __('No', 'chronopost'),
                        'yes' 		=> __('Yes', 'chronopost'),
                    )
                ),
                'tax_status' => array(
                    'title' 		=> __('Tax status', 'chronopost'),
                    'type' 			=> 'select',
                    'default' 		=> 'none',
                    'options'		=> array(
                        'taxable' 	=> __('Taxable', 'chronopost'),
                        'none' 		=> __('None', 'chronopost'),
                    )
                ),
                'free_shipping_enable' => array(
                    'title' 		=> __('Enable Free Shipping', 'chronopost'),
                    'type' 			=> 'checkbox',
                    'label' 		=> __('Enable "Free Shipping" feature depending on below minimum order amount', 'chronopost'),
                    'default' 		=> 'no',
                    'description' 		=> __('This option will enable the "Free shipping" feature. Depending on the customer cart amount the shipping cost will be free or not.', 'chronopost'),
                    'desc_tip'     => true
                ),
                'free_shipping_minimum_amount' => array(
                    'title' 		=> __('Free Shipping minimum order amount required', 'chronopost'),
                    'type' 			=> 'number',
                    'default' 		=> 0,
                    'class'     => 'small-text',
                    'custom_attributes' => array(
                        'step' => 'any'
                    )
                ),
                'table_rates_table' => array(
                    'type'				=> 'table_rates_table'
                )
            );
            }

            /**
                ** This initialises the form field
                */
            public function init_form_fields()
            {
            }

            /**
            * admin_options
            * These generates the HTML for all the options
            */
            public function admin_options()
            {
                ?>
				<h2><?php echo $this->title; ?></h2>
                <table class="form-table">
                    <?php $this->generate_settings_html(); ?>
                </table> 
			<?php
            }
            
            // generate table rate manager
            public function generate_table_rates_table_html()
            {
                ob_start(); ?>
				<tr>
					<th scope="row" class="titledesc"><?php _e('Shipping rates', 'chronopost'); ?></th>
					<td id="<?php echo $this->id; ?>_settings" class="shipping-rate-table" data-rate-lines='<?php echo esc_attr(json_encode($this->options)); ?>' data-countries='<?php echo json_encode($this->country_array); ?>'>
						<table class="shippingrows widefat">
									<col style="width:0%">
									<col style="width:0%">
									<col style="width:0%">
									<col style="width:100%;">
							<thead>
								<tr>
									<th class="check-column"></th>
									<th><?php _e('Shipping Zone Name', 'chronopost') ?></th>
									<th><?php _e('Countries', 'chronopost'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="3" class="add-zone-buttons">
										<a href="#" class="add button"><?php _e('Add New Shipping Zone', 'chronopost'); ?></a>
										<a href="#" class="delete button"><?php _e('Delete Selected Zones', 'chronopost'); ?></a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>				
				<?php
                return ob_get_clean();
            }

            public function get_default_contrat()
            {
	            $accounts = chrono_get_option('accounts');
	            if (!is_array($accounts)) {
		            return '';
	            }
	            return isset($accounts[1]['number']) ? $accounts[1]['number'] : '';
            }

            public function get_contracts_list()
            {
	            $accounts = chrono_get_all_contracts();

	            if (!is_array($accounts)) {
	                return array();
                }
                $options = array();
                foreach ($accounts as $account) {
	                $options[esc_attr($account['number'])] = esc_js($account['label']);
                }
                return $options;
            }

            /**
            * Get the shipping countries
            */
            public function get_shipping_country_list()
            {
                $options = array();
                foreach (WC()->countries->get_shipping_countries() as $country_code => $country_name) :
                    $options['country'][esc_attr($country_code)] = esc_js($country_name);
                endforeach;
                
                return $options;
            }

            /**
            * Make country array
            */
            public function create_select_arrays()
            {
                $this->country_array = array();

                foreach (WC()->countries->get_shipping_countries() as $id => $value) :
                    $this->country_array[esc_attr($id)] = esc_js($value);
                endforeach;
            }

            /**
             * Check if the product is available for the contract
             * @return bool
             */
            private function isAvailableForContract(){

                $ws = new Chronopost_Webservice();
                $default_package = array(
                    'contents'    => array(),
                    'destination' => array(
                        "country"   => "",
                        "state"     => "",
                        "postcode"  => "",
                        "city"      => "",
                        "address"   => "",
                        "address_2" => ""
                    )
                );

                // Produits disponibles pour l'addresse configurée
                $default_package['destination']['country']  = $this->chrono_settings['shipper']['country'];
                $default_package['destination']['postcode'] = $this->chrono_settings['shipper']['zipcode'];
                $default_package['destination']['city']     = $this->chrono_settings['shipper']['city'];
                $allowed = $ws->getMethodIsAllowed($this, $default_package);

                // Produits disponibles en France Metropolitaine
                if(!$allowed){
                    $default_package['destination']['country']  = "FR";
                    $default_package['destination']['postcode'] = "Paris";
                    $default_package['destination']['city']     = "75001";
                    $allowed = $ws->getMethodIsAllowed($this, $default_package);
                }

                // Produits disponibles pour les DOM
                if(!$allowed){
                    $default_package['destination']['country']  = "RE";
                    $default_package['destination']['postcode'] = "974000";
                    $default_package['destination']['city']     = "Saint-Denis";
                    $allowed = $ws->getMethodIsAllowed($this, $default_package);
                }

                // Produits disponibles pour l'Europe
                if(!$allowed){
                    $default_package['destination']['country']  = "DE";
                    $default_package['destination']['postcode'] = "101127";
                    $default_package['destination']['city']     = "Berlin";
                    $allowed = $ws->getMethodIsAllowed($this, $default_package);
                }

                return $allowed;
            }

            /**
            * This saves all of our custom table settings
            */
            public function process_custom_settings()
            {
                // register chronopost method and code in the database if not exists
                $chronopost_methods = get_option('chronopost_shipping_methods', array(), true);
	            $method_settings = chrono_get_method_settings($this->id);
	            $allowed = $this->isAvailableForContract();

	            if (isset($_POST['woocommerce_' . $this->id . '_enabled']) && $_POST['woocommerce_' . $this->id . '_enabled'] === "1" && !$allowed) {
	                if (!defined('CHRONO_RUN_ONCE')) {
                        WC_Admin_Settings::add_error( __("You can't enable this product with this contract. Please contact us for more informations.", 'chronopost'));
                        define('CHRONO_RUN_ONCE', true);
                    }
		            // Event is fired twice
                    $method_settings['enabled'] = '';
                }

	            if ( array_key_exists( $this->id,
			            $chronopost_methods ) && ( ! isset( $chronopost_methods['product_allowed'] )
                        || $chronopost_methods['product_allowed'] !== $allowed ) ) {
		            $chronopost_methods[$this->id]['product_allowed'] = $allowed;
	            }

                if (!array_key_exists($this->id, $chronopost_methods)) {
                    $chronopost_methods = array_merge(
                        array(
                            $this->id => array(
	                            'product_allowed' => $allowed,
                                'product_code' => $this->product_code,
                                'product_code_bal' => $this->product_code_bal,
                                'product_code_str' => $this->product_code_str,
                                'product_code_bal_str' => $this->product_code_bal_str
                            )
                        ),
                        $chronopost_methods
                    );
                    update_option('chronopost_shipping_methods', $chronopost_methods);

                }

	            // Force update enabled setting
                if($method_settings['enabled'] === false)
	                $method_settings['enabled'] = $allowed ? 'yes' : 'no';

	            update_option('woocommerce_' . $this->id . '_settings', $method_settings);

                //Arrays to hold the clean POST vars
                $keys =array();
                $zone_name =array();
                $countries = array();
                $min = array();
                $max = array();
                $shipping = array();
                
                
                // Get the post data from shipping zone configuration

                if (isset($_POST['key'])) {
                    $keys = array_map('wc_clean', $_POST['key']);
                }

                if (isset($_POST['zone-name'])) {
                    $zone_name = array_map('wc_clean', $_POST['zone-name']);
                }
                
                if (isset($_POST['countries'])) {
                    $countries = array_map('wc_clean', $_POST['countries']);
                }

                if (isset($_POST['min'])) {
                    $min = array_map('wc_clean', $_POST['min']);
                }

                if (isset($_POST['max'])) {
                    $max = array_map('wc_clean', $_POST['max']);
                }

                if (isset($_POST['shipping'])) {
                    $shipping = array_map('wc_clean', $_POST['shipping']);
                }
                
                $options = $this->format_shipping_rate_options($zone_name, $countries, $min, $max, $shipping, $keys);
                
                // Save shipping rates options
                update_option($this->option_key, $options);
            }

            public function format_shipping_rate_options($zone_name, $countries, $min, $max, $shipping, $keys)
            {
                $options = array();
                
                // Loop through the array of shipping rates
                foreach ($keys as $key => $value) {
                    // if empty, we continue to next field
                    if (
                        empty($zone_name[$key]) ||
                        empty($countries[ $key ])
                    ) {
                        continue;
                    }
                    
                    // Retrieve the shipping zone name
                    $name =  $zone_name[$key];
                    
                    // Adding the shipping rates
                    $obj =array();
                    foreach ($min[ $key ] as $k => $val) {
                        if (
                            (!is_numeric($min[ $key ][$k]) || empty($min[ $key ][$k])) &&
                            (!is_numeric($max[ $key ][$k]) || empty($max[ $key ][$k])) &&
                            (!is_numeric($shipping[ $key][$k]) || empty($shipping[ $key][$k]))
                        ) {
                            unset($min[ $key ][$k]);
                            unset($max[ $key ][$k]);
                            unset($shipping[ $key ][$k]);
                        } else {
                            //add it to the object array
                            $obj[] = array("min" => $min[ $key ][ $k], "max" => $max[ $key ][ $k], "shipping" => $shipping[ $key ][ $k]);
                        }
                    }
                    
                    usort($obj, 'self::cmp'); // sort the rate datas
                    
                    //create the array to hold the data
                    $options[ $name ] = array();
                    $options[ $name ][ 'countries'] = $countries[ $key ];
                    $options[ $name ][ 'min'] = $min[ $key ];
                    $options[ $name ][ 'max'] = $max[ $key ];
                    $options[ $name ][ 'shipping'] = $shipping[ $key ];
                    $options[ $name ][ 'rates'] = $obj;
                }
                return (array)$options;
            }
            
            // Comparision function for sorting shipping rates
            public function cmp($a, $b)
            {
                return $a['min'] - $b['min'];
            }
        }
    }
}

add_action('woocommerce_shipping_init', 'chronopost_product_init');
