<?php
    /**
     * Cart totals
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce/Templates
     * @version 2.3.6
     */
    defined( 'ABSPATH' ) || exit;
    ?>
    <div>
    <div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?> cart-totals---copy-this">
    
      <?php do_action( 'woocommerce_before_cart_totals' ); ?>
        
      <table cellspacing="0" class="shop_table shop_table_responsive">
    
        <div class="cart-subtotal div-block-9">
          <div class="text-block-81"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
          <div data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
        </div>
    
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
          <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> div-block-9">
            <div class="text-block-81"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
            <div class="text-block-82" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
          </div>
        <?php endforeach; ?>
    
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
    
          <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
    
          <?php wc_cart_totals_shipping_html(); ?>
    
          <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
    
        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
    
          <div class="shipping div-block-9">
            <div class="text-block-81"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></div>
            <div class="text-block-82" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></div>
          </div>
    
        <?php endif; ?>
    
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
          <div class="fee div-block-9">
            <div class="text-block-81"><?php echo esc_html( $fee->name ); ?></div>
            <div class="text-block-82" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></div>
          </div>
        <?php endforeach; ?>
    
        <?php
        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
          $taxable_address = WC()->customer->get_taxable_address();
          $estimated_text  = '';
          if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
            /* translators: %s location. */
            $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
          }
          if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
            foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
              ?>
              <div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> div-block-9">
                <div><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                <div class="text-block-82" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="tax-total div-block-9">
              <div class="text-block-81"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
              <div class="text-block-82" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
            </div>
            <?php
          }
        }
        ?>
    
        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
    
        <div class="order-total div-block-9">
          <div class="text-block-81"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
          <div class="text-block-82" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>
    
        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
    
      </table>
      <div class="checkout-custom-container">
        <a href="<?php the_field('catalogue_particulier', 'option'); ?>" class="btn-arrow-border-white-smoke w-inline-block">
        <div class="btn-arrow-picto w-embed">
          <!--?xml version="1.0" encoding="UTF-8"?-->
          <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
              <path d="M38.083252,15.7116699 C36.2737806,13.8774176 35.0627988,11.2037601 34.4503068,7.69069738 C33.5305055,6.75930511 30.4499069,7.77238081 30.0876244,8.71986625 C29.7253418,9.66735169 29.6738281,9.32830145 29.6738281,10.7895508 C30.4764074,13.5522035 31.5851314,15.6505922 33,17.0847168 C34.2028663,18.3039538 36.4820878,20.2986242 39.8376644,23.0687281 L2.35764899,23.0687281 C1.05782189,23.0687281 0.0001,24.1590404 0.0001,25.4998027 C0.0001,26.840565 1.05782189,27.9308773 2.35764899,27.9308773 L39.8366722,27.9308773 C36.5795055,30.4417354 34.3006148,32.3563779 33,33.6748047 C31.6831003,35.0097394 30.5743764,36.5453026 29.6738281,38.2814941 C29.0578573,39.1601563 28.5371134,40.3015137 28.9975586,41.378418 C29.4580038,42.4553223 32.5305055,44.2413061 33.4503068,43.308908 C34.7994888,39.8302694 36.3438038,37.209315 38.083252,35.4460449 C39.8704255,33.6343959 43.6160429,30.8929716 49.3201042,27.221772 C49.7854621,26.7500409 50.0097071,26.1254247 50.0001,25.4998027 C50.0097071,24.8751865 49.7854621,24.2495645 49.3201042,23.7778334 C43.5460196,20.1410579 39.8004022,17.4523367 38.083252,15.7116699 Z" id="path-arrow"></path>
            </defs>
            <g id="icon/arrow" stroke="none" stroke-width="1">
              <mask id="mask-2" fill="white">
                <use xlink:href="#path-arrow"></use>
              </mask>
              <use id="icon-copy" xlink:href="#path-arrow"></use>
            </g>
          </svg>
        </div>
        <div class="btn-text"><?php _e('Continuer mes achats', 'guard-industrie') ?></div>
      </a>
        <div class="wc-proceed-to-checkout">
          <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button white checkout w-button">
            <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
          </a>
        </div>
    </div>
      <?php do_action( 'woocommerce_after_cart_totals' ); ?>
    
    </div>
    </div>