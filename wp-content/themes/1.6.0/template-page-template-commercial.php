<!DOCTYPE html>
<?php /*
        Template Name: template-commercial
        */ ?> 
        <html <?php language_attributes(); ?> data-wf-page="6076e2bdee93d76058294112" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  
  <meta content="Template Commercial" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  <?php get_template_part('test', 'test'); ?>
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body-navless'; ?>" udesly-page="template-commercial">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div class="header">
    <div class="header-box" style="background-image: url(<?php the_post_thumbnail_url('full') ?>)">
      <div class="header-inside">
        <h2 class="header-title"><?php the_title(); ?></h2>
      </div>
    </div>
  </div>
  <div class="section-commercial">
    <div class="main-wrapper">
      <div class="section-commercial-wrapper">
        <div class="section-commercial-intro">
          <h2 class="main-title-white"><?php _e('Un projet ? Contactez-nous !', 'guard-industrie') ?></h2>
          <div class="subtitle-commercial-container">
            <div class="subtitle-white"><strong><?php _e('Choisissez une zone', 'guard-industrie') ?></strong></div>
          </div>
        </div>
        <div class="section-commercial-filters"><?php wpgb_render_facet(                 	[                 		'id'   => 18,                 		'grid' => 34,                 	]               ); ?></div>
        <div class="section-commercial-grid"><?php wpgb_render_grid( 34 ); ?></div>
      </div>
    </div>
  </div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>