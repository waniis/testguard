<!DOCTYPE html>
<?php /*
        Template Name: liste-ressource-no-filters
        */ ?> 
        <html <?php language_attributes(); ?> data-wf-page="608a7b5e3fcf2c6a2e866ad1" data-wf-site="6033b6808f1a9c208c41042d"><head>
  <meta charset="utf-8">
  
  
  <meta content="Liste-ressource-no-filters" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png?v=1621503422033" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/webclip.png?v=1621503422033" rel="apple-touch-icon">
<?php wp_enqueue_script("jquery"); wp_head(); ?></head>
<body class="<?php echo join(' ', get_body_class() ) . ' body'; ?>" udesly-page="liste-ressource-no-filters">
  
  <?php wp_body_open(); ?>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <nav class="nav"><?php include( locate_template( 'template-parts/nav.php', false, false ) ); ?></nav>
  <div class="header">
    <div class="header-box" style="background-image: url(<?php the_post_thumbnail_url('full') ?>)">
      <div class="header-inside">
        <h2 class="header-title"><?php the_title(); ?></h2>
       
        <?php $book = get_field('has_searchbar'); if( $book ): ?>
          <div class="search-bar-container">php search_Facet(get_field('product_list_grid_id')); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="listing-container">
    <div class="listing-wrapper">
      <div class="<?php listing_class($u_slug); ?>">
        <div class="listing-no-filter-grid-block"><?php gridRender(get_field('product_list_grid_id')); ?></div>
      </div>
    </div>
  </div>
    <?php $book = get_field('book_file');
    if( $book ): ?>
      <div class="book-download-container">
        <a href="<?php the_field('book_file');  ?>" download class="btn-arrow-blue w-inline-block">
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
          <div class="btn-text">Télécharger le Book</div>
        </a>
      </div>
    <?php endif; ?>
    <?php if(get_field('section_best_advices')) :?>
  <div class="slider-advice-container"> 
    <?php include( locate_template( 'template-parts/components/advice-highlight.php', false, false ) ); ?>
  </div>
 <?php endif; ?>
 <footer class="footer-block"><?php include( locate_template( 'template-parts/footer.php', false, false ) ); ?></footer>
  
  <script type="text/javascript">var $ = window.jQuery;</script><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/webflow.js?v=1621503422033" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

<?php wp_footer(); ?><?php endwhile; endif; ?></body></html>