<?php
/**
 *
 * Chronopost Europe offer
 *
 * @since      1.0.0
 * @package    Chronopost
 * @subpackage Chronopost/includes/products
 * @author     Adexos <contact@adexos.fr>
 */
function chronorelaiseurope_init()
{
    if (! class_exists('WC_ChronoRelaisEurope')) {
        class WC_ChronoRelaisEurope extends WC_Chronorelais
        {
            private $chrono_settings;

            public $tracking_url = 'http://www.chronopost.fr/expedier/inputLTNumbersNoJahia.do?lang=fr_FR&listeNumeros={tracking_number}';
            
            public function shipping_method_setting()
            {
                $this->id                 = 'chronorelaiseurope'; // Id for your shipping method. Should be uunique.
                $this->pretty_title       = __('Chronopost - Express delivery in Pickup relay', 'chronopost');  // Title shown in admin
                $this->title       = __('Chrono Relais Europe', 'chronopost');  // Title shown in admin
                $this->method_title       = __('Chrono Relais Europe', 'chronopost');  // Title shown in admin
                $this->method_description = __('In relay Pickup! Order delivered in the pickup relay of your choice', 'chronopost'); // Description shown in admin
                $this->product_code = '49';
                $this->product_code_str = 'PRU';
				$this->max_product_weight = 20;
                $this->product_code_return = '3T';
            }

            public function extra_form_fields()
            {
                parent::extra_form_fields();
                unset($this->form_fields['deliver_on_saturday']);
            }
        }
    }
}

add_action('woocommerce_shipping_init', 'chronorelaiseurope_init');

function add_chronorelaiseurope($methods)
{
    $methods['chronorelaiseurope'] = 'WC_ChronoRelaisEurope';
    return $methods;
}

add_filter('woocommerce_shipping_methods', 'add_chronorelaiseurope');
