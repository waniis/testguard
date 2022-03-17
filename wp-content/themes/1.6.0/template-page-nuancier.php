<!DOCTYPE html>
<?php /*
        Template Name: nuancier
        */ ?> 
        <html <?php language_attributes(); ?> data-wf-page="609904aba02575f9d390e22e" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  
  <meta content="Nuancier" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="nuancier">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div class="nuancier-section">
    <div class="main-wrapper">
      <div class="nuancier-title-container">
        <div class="nuancier-title">
          <h1 class="main-title-blue"><?php the_content();  ?></h1>
        </div>
        <div class="nuancier-selector-wrapper">
          <div class="nuancier-selector nuancier-standard active"><?php _e('Standard', 'guard-industrie') ?></div>
          <div class="nuancier-selector nuancier-metallique"><?php _e('Métallique', 'guard-industrie') ?></div>
        </div>
      </div>
      
      <div class="nuancier-container">
        <div class="nuancier nuancier-standard active">
          <?php if( have_rows('nuancier_list_standard') ): ?>
              <?php while( have_rows('nuancier_list_standard') ): the_row(); ?>
                  <h3 class="heading-22"><?php the_sub_field('nuancier_list_title'); ?></h3>
                   <div class="nuancier-list">
                  <?php $featured_posts = get_sub_field('nuancier_colors');
                    if( $featured_posts ): ?>
                        <?php foreach( $featured_posts as $post ): setup_postdata($post); ?>
                                <a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url('full') ?>); background-size:cover;" class="nuancier-item w-inline-block">
                                  <div class="nuancier-hover">
                                    <div class="nuancier-family"><?php the_sub_field('nuancier_list_title'); ?></div>
                                    <h3><?php the_title(); ?></h3>
                                  </div>
                                </a>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                 
                    
                  </div>
              <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <div class="nuancier nuancier-metallique">
          <?php if( have_rows('nuancier_list_metallique') ): ?>
              <?php while( have_rows('nuancier_list_metallique') ): the_row(); ?>
                  <h3 class="heading-22"><?php the_sub_field('nuancier_list_title'); ?></h3>
                   <div class="nuancier-list">
                  <?php $featured_posts = get_sub_field('nuancier_colors');
                    if( $featured_posts ): ?>
                        <?php foreach( $featured_posts as $post ): setup_postdata($post); ?>
                                <a href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url('full') ?>); background-size:cover;" class="nuancier-item w-inline-block">
                                  <div class="nuancier-hover">
                                    <div class="nuancier-family"><?php the_sub_field('nuancier_list_title'); ?></div>
                                    <h3><?php the_title(); ?></h3>
                                  </div>
                                </a>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                  </div>
              <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>