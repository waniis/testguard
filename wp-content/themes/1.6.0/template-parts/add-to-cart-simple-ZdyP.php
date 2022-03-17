<?php
defined( 'ABSPATH' ) || exit;
global $product;
if ( ! $product->is_purchasable() ) {
	return;
}
echo wc_get_stock_html( $product );

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
              <?php if ( $product->is_in_stock() ) : do_action( 'woocommerce_before_add_to_cart_form' ); ?><form data-node-type="commerce-add-to-cart-form" class="w-commerce-commerceaddtocartform" udy-el="single-simple-add-to-cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data"><?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                <div class="add-to-cart-main-wrapper">
                  
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
                    </div><button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt w-commerce-commerceaddtocartbutton button-6 white"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                  </div>
                </div>
              </form><?php do_action( 'woocommerce_after_add_to_cart_form' ); endif; ?>
              <div style="<?php echo $product->is_in_stock() ? "display: none": ""; ?>" class="w-commerce-commerceaddtocartoutofstock out-of-stock-state-2">
                <div>Produit non disponible</div>
              </div>
              <div data-node-type="commerce-add-to-cart-error" style="display:none" class="w-commerce-commerceaddtocarterror error-message-6">
                <div data-node-type="commerce-add-to-cart-error" data-w-add-to-cart-quantity-error="Le produit n'est pas disponible" data-w-add-to-cart-general-error="Un problème est survenu lors de l'ajout du produit" data-w-add-to-cart-mixed-cart-error="You can’t purchase another product with a subscription." data-w-add-to-cart-buy-now-error="Something went wrong when trying to purchase this item." data-w-add-to-cart-checkout-disabled-error="Checkout is disabled on this site." data-w-add-to-cart-select-all-options-error="Une erreur s'est produite lors de la tentative d'achat de cet article.">Le produit n'est pas disponible</div>
              </div>
            </div>

