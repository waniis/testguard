<!DOCTYPE html>
<html <?php language_attributes(); ?> data-wf-page="6038c7ab31e1816f9285397b" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="checkout"><?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  <?php wp_body_open(); ?>

  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <?php if(!is_user_logged_in()) : ?><div class="section">
    <div class="checkout-connexion">
      <h3><?php _e('Déjà client ?', 'guard-industrie') ?></h3>
      <div class="connect-form w-form">
        <form id="email-form" name="email-form" redirect="../checkout/" class="connect-form-block" action="login" method="post" udesly-wp-ajax="login"><label for="username"><?php _e(' Adresse email', 'guard-industrie') ?><br></label><input type="text" class="text-field-6 w-input" autofocus="true" maxlength="256" name="log" data-name="Username" id="log" required=""><label for="password"><?php _e('Mot de passe', 'guard-industrie') ?></label><input type="password" class="text-field-7 w-input" maxlength="256" name="pwd" data-name="Password" id="pwd" required=""><label class="w-checkbox"><input type="checkbox" id="remember_me" name="remember_me" data-name="Remember Me" class="w-checkbox-input"><span for="remember_me" class="w-form-label"><?php _e('Se souvenir de moi', 'guard-industrie') ?></span></label>
          <div class="form-btn-block"><input type="submit" value="se connecter" data-wait="Patientez ..." class="btn-submit w-button" name="wp-submit"></div>
        <input type="hidden" name="redirect_to" value="../checkout/"><?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?></form>
        <div class="success-message w-form-done">
          <div><?php _e('Thank you! Your submission has been received!', 'guard-industrie') ?></div>
        </div>
        <div class="w-form-fail">
          <div udy-el="error-message"><?php _e('Oops! Something went wrong while submitting the form.', 'guard-industrie') ?></div>
        </div>
      </div>
    </div>
  </div><?php endif; ?>
  <div data-node-type="commerce-checkout-form-container" data-wf-checkout-query="" data-wf-page-link-href-prefix="" class="w-commerce-commercecheckoutformcontainer checkout-form">
    <div class="w-commerce-commercelayoutcontainer w-container"><?php udesly_wc_webflow_checkout('{"w":"w-commerce-commercelayoutcontainer w-container","c_w":"w-commerce-commercecheckoutcustomerinfowrapper","i":"w-commerce-commercecheckoutemailinput","o":"w-commerce-commercecheckoutshippingcountryselector","h":"w-commerce-commercecheckoutblockheader","l":"w-commerce-commercecheckoutlabel","m":"w-commerce-commercelayoutmain","s":"w-commerce-commercelayoutsidebar div-block-305","c":"w-commerce-commercecheckoutblockcontent","header":"H4","header_c":"","l_i":"w-commerce-commercecheckoutsummarylineitem","b":"w-commerce-commercecheckoutplaceorderbutton main-button"}'); ?></div>
  </div>

  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <script type="text/javascript">
    <?php 
    foreach(WC()->session->get('cart') as $key => $item) {
    $order_amout_ati += $item['line_total'] + $item['line_tax'];
    $order_amount_tf += $item['line_total'];
    } ?>

    window.dataLayer.push({
      "event":"account-creation-success"
    })
    console.log(window.dataLayer);
  </script>
<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>