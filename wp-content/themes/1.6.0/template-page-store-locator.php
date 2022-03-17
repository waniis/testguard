<!DOCTYPE html>
<?php /*
        Template Name: store-locator
        */ ?> 
        <html <?php language_attributes(); ?> data-wf-page="604f991abff6c07def1fcd00" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  
  <meta content="store-locator" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="store-locator">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div class="header">
    <div class="header-box" style="background-image: url(<?php the_post_thumbnail_url('full') ?>)">
      <div class="header-inside">
        <h2 class="header-title"><?php the_title(); ?></h2>
        <div class="paragraph-white header-description"><?php the_content(); ?></div>
      </div>
    </div>
  </div>
  <div class="store-locator-container">
    <div class="store-locator-wrapper"><?php include( locate_template( 'template-parts/store-locator.php', false, false ) ); ?></div>
  </div>
  <div class="section-partners">
    <h2 class="main-title-white"><?php _e('Nos Partenaires e-commerce', 'guard-industrie') ?></h2>
    <ul role="list" class="partners-list w-list-unstyled"><?php partners_List(); ?></ul>
  </div>
  <div class="section-reference-container"><?php include( locate_template( 'template-parts/components/section-reference.php', false, false ) ); ?></div>
  <div class="section-documentation"><?php include( locate_template( 'template-parts/components/section-documents.php', false, false ) ); ?></div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>