<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="6038c7ab31e18199f985397e" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  <base target="_parent">
  
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="paypal-checkout">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div data-node-type="commerce-paypal-checkout-form-container" data-wf-checkout-query="" data-wf-page-link-href-prefix="" class="w-commerce-commercepaypalcheckoutformcontainer">
    <div class="w-commerce-commercelayoutcontainer w-container">
      <div class="w-commerce-commercelayoutmain">
        <form data-node-type="commerce-checkout-shipping-methods-wrapper" class="w-commerce-commercecheckoutshippingmethodswrapper">
          <div class="w-commerce-commercecheckoutblockheader">
            <h4><?php _e('Shipping Method', 'guard-industrie') ?></h4>
          </div>
          <fieldset>
            <script type="text/x-wf-template" id="wf-template-6038c7ab31e1816acd85397f000000000012">%3Clabel%20class%3D%22w-commerce-commercecheckoutshippingmethoditem%22%3E%3Cinput%20type%3D%22radio%22%20required%3D%22%22%20name%3D%22shipping-method-choice%22%2F%3E%3Cdiv%20class%3D%22w-commerce-commercecheckoutshippingmethoddescriptionblock%22%3E%3Cdiv%20class%3D%22w-commerce-commerceboldtextblock%22%3E%3C%2Fdiv%3E%3Cdiv%3E%3C%2Fdiv%3E%3C%2Fdiv%3E%3Cdiv%3E%3C%2Fdiv%3E%3C%2Flabel%3E</script>
            <div data-node-type="commerce-checkout-shipping-methods-list" class="w-commerce-commercecheckoutshippingmethodslist" data-wf-collection="database.commerceOrder.availableShippingMethods" data-wf-template-id="wf-template-6038c7ab31e1816acd85397f000000000012"><label class="w-commerce-commercecheckoutshippingmethoditem"><input type="radio" required="" name="shipping-method-choice">
                <div class="w-commerce-commercecheckoutshippingmethoddescriptionblock">
                  <div class="w-commerce-commerceboldtextblock"></div>
                  <div></div>
                </div>
                <div></div>
              </label></div>
            <div data-node-type="commerce-checkout-shipping-methods-empty-state" style="display:none" class="w-commerce-commercecheckoutshippingmethodsemptystate">
              <div><?php _e('No shipping methods are available for the address given.', 'guard-industrie') ?></div>
            </div>
          </fieldset>
        </form>
        <div class="w-commerce-commercecheckoutcustomerinfosummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Customer Information', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutrow">
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Email', 'guard-industrie') ?></label>
                  <div></div>
                </div>
              </div>
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Shipping Address', 'guard-industrie') ?></label>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                  </div>
                  <div></div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="w-commerce-commercecheckoutpaymentsummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Payment Info', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutrow">
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Payment Info', 'guard-industrie') ?></label>
                  <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                  </div>
                </div>
              </div>
              <div class="w-commerce-commercecheckoutcolumn">
                <div class="w-commerce-commercecheckoutsummaryitem"><label class="w-commerce-commercecheckoutsummarylabel"><?php _e('Billing Address', 'guard-industrie') ?></label>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                  </div>
                  <div></div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="w-commerce-commercecheckoutorderitemswrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Items in Order', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <script type="text/x-wf-template" id="wf-template-6038c7ab31e1816acd85397f000000000050"></script>
            <div class="w-commerce-commercecheckoutorderitemslist" data-wf-collection="database.commerceOrder.userItems" data-wf-template-id="wf-template-6038c7ab31e1816acd85397f000000000050"></div>
          </fieldset>
        </div>
      </div>
      <div class="w-commerce-commercelayoutsidebar">
        <div class="w-commerce-commercecheckoutordersummarywrapper">
          <div class="w-commerce-commercecheckoutsummaryblockheader">
            <h4><?php _e('Order Summary', 'guard-industrie') ?></h4>
          </div>
          <fieldset class="w-commerce-commercecheckoutblockcontent">
            <div class="w-commerce-commercecheckoutsummarylineitem">
              <div><?php _e('Subtotal', 'guard-industrie') ?></div>
              <div></div>
            </div>
            <script type="text/x-wf-template" id="wf-template-6038c7ab31e1816acd85397f00000000006a">%3Cdiv%20class%3D%22w-commerce-commercecheckoutordersummaryextraitemslistitem%22%3E%3Cdiv%3E%3C%2Fdiv%3E%3Cdiv%3E%3C%2Fdiv%3E%3C%2Fdiv%3E</script>
            <div class="w-commerce-commercecheckoutordersummaryextraitemslist" data-wf-collection="database.commerceOrder.extraItems" data-wf-template-id="wf-template-6038c7ab31e1816acd85397f00000000006a">
              <div class="w-commerce-commercecheckoutordersummaryextraitemslistitem">
                <div></div>
                <div></div>
              </div>
            </div>
            <div class="w-commerce-commercecheckoutsummarylineitem">
              <div><?php _e('Total', 'guard-industrie') ?></div>
              <div class="w-commerce-commercecheckoutsummarytotal"></div>
            </div>
          </fieldset>
        </div>
        <a href="#" value="Place Order" data-node-type="commerce-checkout-place-order-button" class="w-commerce-commercecheckoutplaceorderbutton" data-loading-text="Placing Order..."><?php _e('Place Order', 'guard-industrie') ?></a>
        <div data-node-type="commerce-checkout-error-state" style="display:none" class="w-commerce-commercepaypalcheckouterrorstate">
          <div class="w-checkout-error-msg" data-w-info-error="There was an error processing your customer info.  Please try again, or contact us if you continue to have problems." data-w-shipping-error="Sorry. We can’t ship your order to the address provided." data-w-billing-error="Your payment could not be completed with the payment information provided.  Please make sure that your card and billing address information is correct, or try a different payment card, to complete this order.  Contact us if you continue to have problems." data-w-payment-error="There was an error processing your payment.  Please try again, or contact us if you continue to have problems." data-w-pricing-error="The prices of one or more items in your cart have changed. Please refresh this page and try again." data-w-extras-error="A merchant setting has changed that impacts your cart. Please refresh and try again." data-w-product-error="One or more of the products in your cart have been removed. Please refresh the page and try again." data-w-invalid-discount-error="This discount is invalid." data-w-expired-discount-error="This discount is no longer available." data-w-usage-reached-discount-error="This discount is no longer available." data-w-requirements-not-met-error="Your order does not meet the requirements for this discount."><?php _e('There was an error processing your customer info. Please try again, or contact us if you continue to have problems.', 'guard-industrie') ?></div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>