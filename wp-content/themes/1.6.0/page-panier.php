<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="6038df087b02ee96853e9f8a" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  
  <meta content="Panier" property="twitter:title">
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


<?php
$user=wp_get_current_user();
$cart = WC()->cart;

?>


var email = '<?=$user->user_email ?>';

var properties = {
  "email": '<?=$user->user_email ?>',
  'prenom': '<?=$user->first_name ?>',
  'nom' : '<?=$user->last_name ?>',
 
}


//sendinblue.identify(email,properties);


        var track_event = {
            "data": {
                "total": <?=$cart->total;?>,
                "currency": "€",
                "url": "<?= wc_get_cart_url(); ?>",
                
                "items": [      
                   <?php 
                   foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                     $product = $cart_item['data'];
                     //var_dump($product);{
                     ?>              
                  {
              
                   <?php 
                                      //"variant_name":
                     $main_image_url = wp_get_attachment_image_url($product->get_image_id(), 'medium'); 

                               ?>
                    "name": "<?=$product->get_name();?>",
                    "price": <?= number_format(floatval($cart_item['data']->get_price())*1.2,2);?>,
                    "quantity": <?=$cart_item['quantity']?>,
                    "url": "<?=$product->get_permalink( $cart_item )?>",
                    "image": "<?=  $main_image_url ?>"
                }, 
                <?php endforeach; ?>
                ]
            }
        }
        
<?php if(!$cart->is_empty()){ ?>
sendinblue.track("cart_updated", properties, track_event);
<?php }else{ ?>

sendinblue.track("cart_deleted", properties);

<?php } ?>
</script>

</head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="panier">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <?php do_action('woocommerce_before_cart'); $cart_items = WC()->cart->get_cart() ?><div class="cart-wrapper w-form <?php echo count($cart_items) == 0 ? "empty" : "" ?>" udy-el="wc-cart">
    <form name="email-form" class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post"><?php do_action('woocommerce_before_cart_table'); ?>
      <div class="table-header w-hidden-tiny">
        <div class="table-header-data-2 product">
          <p class="table-header-label"><?php _e('Produit', 'guard-industrie') ?></p>
        </div>
        <div class="table-header-data-2">
          <p class="table-header-label"><?php _e('PRIX', 'guard-industrie') ?></p>
        </div>
        <div class="table-header-data-2">
          <p class="table-header-label"><?php _e('QUANTITÉ', 'guard-industrie') ?></p>
        </div>
        <div class="table-header-data-2">
          <p class="table-header-label"><?php _e('Total', 'guard-industrie') ?></p>
        </div>
      </div>
      <div class="w-dyn-list woocommerce-cart-form__contents">
        <div role="list" class="collection-list-9 w-dyn-items">
          <?php foreach( $cart_items as $cart_item_key => $cart_item) : $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key ); $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key ); if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) : $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ); $main_image_url = wp_get_attachment_image_url($_product->get_image_id(), 'medium'); $main_image_url = $main_image_url ? $main_image_url : esc_url(wc_placeholder_img_src()); ?><div role="listitem" class="collection-item-2 w-dyn-item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
            <div class="cart-row---copy-this">
              <div class="table-row-data product">
                <div class="product-info-wrapper">
                  <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" class="link-block-11 w-inline-block" data-product_id="<?php echo esc_attr( $product_id ) ?>" data-product_sku="<?php echo esc_attr( $_product->get_sku() ) ?>">
                    <div class="text-block-96"><?php _e('x', 'guard-industrie') ?></div><img src="https://uploads-ssl.webflow.com/5de9029010e995230514953f/5de9029110e9954c481495c3_trash.main.svg" width="20" alt="">
                  </a><img src="<?php echo $main_image_url; ?>" width="80" alt="" class="image-35">
                  <div class="div-block-162">
                    <a href="<?php echo $product_permalink; ?>" class="link-7"><?php echo $_product->get_name(); ?></a>
                    <div class="text-block-98"><?php echo wc_get_formatted_cart_item_data( $cart_item ); ?></div>
                  </div>
                </div>
              </div>
              <div class="table-row-data price">
                <div class="price-3"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
              </div>
              <div class="table-row-data quantity"><?php udesly_quantity_input_cart_item($_product, $cart_item_key, $cart_item, ["text-field-4","w-input"]); ?></div>
              <div class="table-row-data total">
                <div class="text-block-80"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></div>
              </div>
            </div>
          </div><?php endif; endforeach; ?>
        </div>
        <?php if (count($cart_items) == 0) : ?><div class="empty-state-3 w-dyn-empty">
          <div class="div-block-74">
            <h1 class="heading-16"><?php _e('Votre panier est vide.', 'guard-industrie') ?></h1>
          </div>
        </div><?php endif; ?>
      </div><?php do_action('woocommerce_cart_contents'); ?>
      <div class="div-block-7"><?php if ( wc_coupons_enabled() ) : ?><input type="text" class="text-field-3 w-node-cdea1027-8431-f25a-864f-99e37a6af8e9-853e9f8a w-input" maxlength="256" name="coupon_code" placeholder="Code Coupon" id="coupon_code"><?php do_action( 'woocommerce_cart_coupon' ); endif; ?><input type="submit" value="Valider" data-wait="Validation..." class="button white w-button" name="apply_coupon"><input type="submit" value="Mettre à jour le panier" data-wait="mise à jour ..." id="w-node-cdea1027-8431-f25a-864f-99e37a6af8eb-853e9f8a" class="button white update-cart w-button" name="update_cart"><?php do_action( 'woocommerce_cart_actions' ); wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?></div>
      <div class="div-block-176">
        <?php woocommerce_cart_totals(); ?>
      </div>
    <?php do_action('woocommerce_after_cart_table'); ?><?php do_action( 'woocommerce_after_cart_contents' ); ?></form>
    <div class="w-form-done">
      <div><?php _e('Thank you! Your submission has been received!', 'guard-industrie') ?></div>
    </div>
    <div class="w-form-fail">
      <div><?php _e('Oops! Something went wrong while submitting the form.', 'guard-industrie') ?></div>
    </div>
  </div>
  <div class="back-to-product-container">
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
  </div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>