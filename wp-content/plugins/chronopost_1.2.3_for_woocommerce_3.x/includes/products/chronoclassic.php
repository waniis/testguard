<?php
/**
 *
 * Chronopost Classic offer
 *
 * @since      1.0.0
 * @package    Chronopost
 * @subpackage Chronopost/includes/products
 * @author     Adexos <contact@adexos.fr>
 */
function chronoclassic_init()
{
    if (! class_exists('WC_Chronoclassic')) {
        class WC_Chronoclassic extends WC_Chronopost_Product
        {
            public function shipping_method_setting()
            {
                $this->id                 = 'chronoclassic'; // Id for your shipping method. Should be uunique.
                $this->pretty_title       = __('Express delivery at home', 'chronopost');  // Title shown in admin
                $this->title       = __('Chrono Classic', 'chronopost');  // Title shown in admin
                $this->method_title       = __('Chrono Classic', 'chronopost');  // Title shown in admin
                $this->method_description = __('Parcels delivered to Europe in 1 to 3 days', 'chronopost'); // Description shown in admin
                $this->product_code = '44';
                $this->product_code_str = 'CClassic';
            }
            public function extra_form_fields()
            {
                parent::extra_form_fields();
                unset($this->form_fields['deliver_on_saturday']);
            }
        }
    }
}

add_action('woocommerce_shipping_init', 'chronoclassic_init');

function add_chronoclassic($methods)
{
    $methods['chronoclassics'] = 'WC_Chronoclassic';
    return $methods;
}

add_filter('woocommerce_shipping_methods', 'add_chronoclassic');
