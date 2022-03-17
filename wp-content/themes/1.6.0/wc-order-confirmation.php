<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="6038c7ab31e181b61c853981" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?>


<script type="text/javascript">
(function() {
    window.sib = {
        equeue: [],
        client_key: "<?php the_field('id_sendinblue', 'options') ?>" //gs7u9rakxfvrof29pjrlcpbi
    };
    /* OPTIONAL: email for identify request*/
    // window.sib.email_id = 'example@domain.com';
    window.sendinblue = {};
    for (var j = ['track', 'identify', 'trackLink', 'page'], i = 0; i < j.length; i++) {
    (function(k) {
        window.sendinblue[k] = function() {
            var arg = Array.prototype.slice.call(arguments);
            (window.sib[k] || function() {
                    var t = {};
                    t[k] = arg;
                    window.sib.equeue.push(t);
                })(arg[0], arg[1], arg[2]);
            };
        })(j[i]);
    }
    var n = document.createElement("script"),
        i = document.getElementsByTagName("script")[0];
    n.type = "text/javascript", n.id = "sendinblue-js", n.async = !0, n.src = "https://sibautomation.com/sa.js?key=" + window.sib.client_key, i.parentNode.insertBefore(n, i), window.sendinblue.page();
})();




<?php $user=wp_get_current_user(); ?>


var email = '<?=$user->user_email ?>';

var properties = {
  "email": '<?=$user->user_email ?>',
  'FIRSTNAME': '<?=$user->first_name ?>',
  'LASTNAME' : '<?=$user->last_name ?>',
}


sendinblue.track(
  'order_completed',properties 
);
</script>


</head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="order-confirmation">
  
  <?php wp_body_open(); ?>
  
  <?php global $wc_order; order_received_empty_cart_action(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div class="title-order-confirmation">
    
    <script>
      window.dataLayer.push({
				"event":"order-confirmation",
				"order_id": <?= $wc_order->get_order_number() ?>,
				"order_amount_ati": <?= number_format( $wc_order->get_total(), wc_get_price_decimals(), '.', '' ); ?>,
				"order_currency": "<?= $wc_order->get_currency() ?>",
				"payment_method": "<?= $wc_order->get_payment_method_title() ?>",
				"order_affiliation": "web",
				
				"order_tax": <?= $wc_order->get_total_tax() - $wc_order->get_shipping_tax(); ?>,
				
				<?php	// get tax rate label
          foreach( $wc_order->get_items('tax') as $item ) {
          $subject = $item->get_label();
          $pattern = '/\d+\.?\d*/';
          preg_match($pattern, $subject, $matches);
          $dl_tax = $matches[0];
        } 
        ?>
				"tax_rate": <?= $dl_tax ?>,
				"order_shipping": <?= $wc_order->get_total_shipping() ?>,
				
				
				
				
				
				<?php // get sum(all products) tax free
  			  $dl_all_products_price_tf = 0;
				  foreach($wc_order->get_items() as $item_id => $item) { 
				    $dl_all_products_price_tf += $item->get_subtotal();
				  }
			  ?>
				<?php 
				$dl_concat_codes = ''; // string to store all coupons names
				$dl_sum_discount_amounts = ''; // float to store total discount amount
				
				$dl_coupons = $wc_order->get_coupon_codes();// get all used coupons
				
				// $has_product_restricted_coupons = false;
				// $restricted_coupons = [];
				
  			if ( $dl_coupons ): 
  			  
  			  foreach( $dl_coupons as $coupon_code ) {
				    $dl_coupon = new WC_Coupon($coupon_code); // Get the WC_Coupon object
				    
				    $dl_coupon_code = $dl_coupon->get_code();
				    
				    // compute coupon discount amount depending of coupon type
				    $dl_discount_type = $dl_coupon->get_discount_type(); // "percent"
				    $dl_coupon_amount = $dl_coupon->get_amount(); // 5 (%)
				    if ( $dl_discount_type == "percent" ) {
				      $true_discount_amount = number_format( $dl_all_products_price_tf * $dl_coupon_amount / 100, 2, '.', '');
				    } else { // remise fixe
				      $true_discount_amount = number_format( $dl_all_products_price_tf - $dl_coupon_amount, 2, '.', '');
				    }
				    
				    // concat results
				    $dl_concat_codes .= $dl_coupon_code . ',';
				    $dl_sum_discount_amounts += $true_discount_amount . ',';
				    
				    
				    // Check if some coupons are product-restricted
				    // $coupon_is_product_restricted = count( $dl_coupon->get_product_ids()) > 0;
				    // if ( $coupon_is_product_restricted ) {
				    //   $has_product_restricted_coupons = true;
				    //   foreach(  $dl_coupon->get_product_ids() as $productid ) {
				    //     $restricted_coupons[$productid] = $dl_coupon;
				    //   }
				    // }
				    // var_dump( 'restricted coupons', $restricted_coupons );
				    
  				} 
  				// remove trailing commas
  				$dl_concat_codes = rtrim($dl_concat_codes,',');
  				$dl_sum_discount_amounts = rtrim($dl_sum_discount_amounts,',')
  				?>
  				"order_coupon": "<?= $dl_concat_codes ?>",
  				"order_coupon_amount": "<?= $dl_sum_discount_amounts ?>",
  			<?php endif; ?>
  			
  			<?php // "order_amount_tf": <?= number_format( $wc_order->get_total() - $wc_order->get_total_tax() - $wc_order->get_total_shipping(), wc_get_price_decimals(), '.', '' );   ,  ?>
				"order_amount_tf": <?= $dl_coupons ? $dl_all_products_price_tf - $dl_sum_discount_amounts : $dl_all_products_price_tf ?>,
				
				
				"product": [
				
				<?php // get each product data
				  foreach($wc_order->get_items() as $item_id => $item):
				    
				    // get product name
  				  $dl_product_title = wc_get_product( $item->get_product_id() )->get_title();
  				  
  				  // get product category
  				  $dl_category = get_the_terms( $item->get_product_id(), 'gamme' )[0]->name;
  				  
  				  // get product variation (if any)
  				  $dl_variations = wc_get_product( $item->get_variation_id() );
  				  $dl_has_var = count($dl_variations) > 0;
  				  if ( $dl_has_var ) {
  				    foreach ( $dl_variations->get_variation_attributes() as $key => $value ) {
  			        $dl_variation = strtoupper( $value );
  				    }
  				  }
			  ?>
				{
					"product_id": <?= $item->get_product_id() ?>,
					"product_name": "<?= $dl_product_title ?>",
					"product_quantity": <?= $item->get_quantity() ?>,
					"product_category": "<?= $dl_category ?>",
					"product_brand": "Guard",
					"product_price_ati": <?= $item->get_subtotal() + $item->get_subtotal_tax() ?>,
					"product_price_tf": <?= $item->get_subtotal() ?> ,
					<?php if ( $dl_has_var ): ?>"product_variant": "<?= $dl_variation ?>",<?php endif; ?>
				},
				<?php endforeach; ?>
				],
			})
		</script>
    
    <h2 class="heading-21"><?php _e('Nous vous remercions pour votre commande. ', 'guard-industrie') ?><br><?php _e('Vous recevrez bientôt un mail de confirmation de votre commande. ', 'guard-industrie') ?><br><?php _e('À très bientôt sur Guard Industrie !', 'guard-industrie') ?></h2>
  </div>
  <div data-node-type="commerce-order-confirmation-wrapper" data-wf-order-query="" data-wf-page-link-href-prefix="" class="w-commerce-commerceorderconfirmationcontainer order-confirmation-2">
    <div class="w-commerce-commercelayoutcontainer w-container">
      <div class="w-commerce-commercelayoutmain">
        <div class="w-commerce-commercecheckoutpaymentsummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Détails ', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent confirl-details">
            <ul role="list" class="w-list-unstyled">
              <?php foreach($wc_order->get_items() as $item_id => $item) : $data = (object) $item->get_data(); $item_image = get_the_post_thumbnail_url($data->product_id); if (!$item_image) { $item_image = wc_placeholder_img_src(); } ?><li class="confirm-item">
                <div class="confirm-title">
                  <div class="confirm-product"><?php echo $data->name; ?></div>
                </div><img src="<?php echo $item_image; ?>" alt="" class="w-commerce-commercecartitemimage">
              </li><?php endforeach; ?>
            </ul>
          </fieldset>
        </div>
        <div class="w-commerce-commercecheckoutcustomerinfosummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Informations personnelles', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutrow">
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Email', 'guard-industrie') ?></label>
                  <div><?php echo $wc_order->get_billing_email(); ?></div>
                </div>
              </div>
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Adresse de livraison', 'guard-industrie') ?></label>
                  <div><?php echo $wc_order->has_shipping_address() ? $wc_order->get_formatted_shipping_address() : $wc_order->get_formatted_billing_address(); ?></div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="w-commerce-commercecheckoutpaymentsummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Informations de paiement', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutrow">
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Mode de paiement', 'guard-industrie') ?></label>
                  <div class="w-commerce-commercecheckoutsummaryflexboxdiv"><?php echo wp_kses_post( $wc_order->get_payment_method_title() ); ?></div>
                </div>
              </div>
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Adresse de facturation', 'guard-industrie') ?></label>
                  <div><?php echo $wc_order->get_formatted_billing_address(); ?></div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="w-commerce-commercelayoutsidebar">
        <div class="w-commerce-commercecheckoutordersummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Votre commande', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutsummarylineitem">
              <div><?php _e('Total', 'guard-industrie') ?></div>
              <div class="w-commerce-commercecheckoutsummarytotal"><?php echo $wc_order->get_formatted_order_total(); ?></div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?></body></html>