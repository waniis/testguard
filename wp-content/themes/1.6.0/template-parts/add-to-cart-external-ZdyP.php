<?php
defined( 'ABSPATH' ) || exit;

global $product;

$product_url = $product->add_to_cart_url();
		if ( ! $product_url ) {
			return;
		}

 $button_text = $product->single_add_to_cart_text();
?>

<div class="add-to-cart-2">
              <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?><form data-node-type="commerce-add-to-cart-form" class="w-commerce-commerceaddtocartform" udy-el="single-external-add-to-cart" action="<?php echo $product_url; ?>" method="get"><?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <button type="submit" class="single_add_to_cart_button button alt w-commerce-commerceaddtocartbutton button-6 white"><?php echo esc_html( $button_text ); ?></button>
    
    <?php wc_query_string_form_fields( $product_url ); ?>
    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form><?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
              
              
            </div>

