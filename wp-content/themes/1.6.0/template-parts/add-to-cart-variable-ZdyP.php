<?php
    defined( 'ABSPATH' ) || exit;

    global $product;
    
    wp_enqueue_script( 'wc-add-to-cart-variation' );
    
    $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
        // Load the template.
    
    $available_variations = $get_variations ? $product->get_available_variations() : false;
    $attributes          = $product->get_variation_attributes();
    $selected_attributes  = $product->get_default_attributes();
    
    $attribute_keys  = array_keys( $attributes );
    $variations_json = wp_json_encode( $available_variations );
    $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

    $defaults = array(
      'input_id'     => uniqid( 'quantity_' ),
      'input_name'   => 'quantity',
      'input_value'  => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
      'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
      'max_value'    => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
      'min_value'    => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
      'step'         => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
      'pattern'      => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
      'inputmode'    => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
      'product_name' => $product ? $product->get_title() : '',
    );
    $args = apply_filters( 'woocommerce_quantity_input_args', $defaults, $product );
    
    extract($args);

$max_value = 0 < $max_value ? $max_value : '';
if ( '' !== $max_value && $max_value < $min_value ) {
    $max_value = $min_value;
}
?>

<div class="add-to-cart-2">
              <?php if ( !empty( $available_variations ) ) : do_action( 'woocommerce_before_add_to_cart_form' ); ?><form data-node-type="commerce-add-to-cart-form" class="w-commerce-commerceaddtocartform variations_form" udy-el="wc-variable-add-to-cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data" data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; ?>"><?php do_action( 'woocommerce_before_variations_form' ); ?>
                <div class="add-to-cart-main-wrapper">
                  <div class="variations" udy-el="wc-variations-options"><?php foreach(udesly_wc_get_variations($attributes) as $variation) : ?><div item="variations" class="variations-wrapper">
                    <div class="variations-main-wrapper"><?php foreach($variation->options as $option) :  ?><label item="variation-title" class="variation-2" style="<?php echo $option->image; ?>" for="<?php echo $option->for; ?>"><?php echo $option->image != "" ? "" : $option->label; ?>
    <input id="<?php echo $option->id; ?>" style="display: none;" type="radio" name="<?php echo $option->name; ?>" value="<?php echo $option->value; ?>" <?php echo $option->checked ? "checked" : ""; ?>>
  </label><?php endforeach; ?></div>
                  </div><?php endforeach; ?></div>
                  <div class="button-wrapper">
                    <div class="quantity-wrapper">
                      <div class="quatity-btn-less">
                        <div class="quatity-lines">
                          <div class="line"></div>
                        </div>
                      </div><?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?><input type="number" pattern="<?php echo $pattern ?>" inputmode="<?php echo $inputmode ?>" id="<?php echo uniqid( 'quantity_' ); ?>" name="quantity" min="<?php echo $min_value; ?>" class="w-commerce-commerceaddtocartquantityinput quantity-3" value="<?php echo $input_value; ?>" max="<?php echo $max_value; ?>" step="<?php echo $step ?>"><?php do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                      <div class="quatity-btn-more">
                        <div class="quantity-lines">
                          <div class="line"></div>
                          <div class="line second"></div>
                        </div>
                      </div>
                    </div><?php do_action( 'woocommerce_before_add_to_cart_button' ); ?><button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt w-commerce-commerceaddtocartbutton button-6 white"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button><?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                  </div>
                </div>
              <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"><input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"><input type="hidden" name="variation_id" value="0" class="variation_id"><?php do_action( 'woocommerce_after_variations_form' ); ?></form><?php do_action( 'woocommerce_after_add_to_cart_form' ); endif; ?>
              <div style="<?php echo empty( $available_variations ) && false !== $available_variations  ? "": "display: none"; ?>" class="w-commerce-commerceaddtocartoutofstock out-of-stock-state-2">
                <div>Produit non disponible</div>
              </div>
              <div data-node-type="commerce-add-to-cart-error" style="display:none" class="w-commerce-commerceaddtocarterror error-message-6">
                <div data-node-type="commerce-add-to-cart-error" data-w-add-to-cart-quantity-error="Le produit n'est pas disponible" data-w-add-to-cart-general-error="Un problème est survenu lors de l'ajout du produit" data-w-add-to-cart-mixed-cart-error="You can’t purchase another product with a subscription." data-w-add-to-cart-buy-now-error="Something went wrong when trying to purchase this item." data-w-add-to-cart-checkout-disabled-error="Checkout is disabled on this site." data-w-add-to-cart-select-all-options-error="Une erreur s'est produite lors de la tentative d'achat de cet article.">Le produit n'est pas disponible</div>
              </div>
            </div>

