  <div class="main-wrapper">
      <div class="reference-intro-container">
         <h1 class="main-title-blue"><?php the_title(); ?></h1>
         <div class="reference-city" style="color: #000; letter-spacing: 1px;"><?php the_field('reference_city') ?></div>
      </div>
      <div class="reference-gallery-container">
        <div class="slider-reference-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1616076940153" loading="lazy" alt="" class="image-40"></div>
        <div class="slider-reference-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1616076940153" loading="lazy" alt="" class="image-41"></div>
        <div class="swiper-container reference-slider">
          <div class="swiper-wrapper">
            <?php 
              $images = get_field('reference_gallery');
              if( $images ): ?>
              <?php foreach( $images as $image ): ?>
               <div class="swiper-slide reference-slide">
                  <div class="reference-slide-box">
                    <img src="<?php echo esc_url($image['url']); ?>" loading="lazy" alt="" class="reference-slide-inside">
                  </div>
               </div>
               <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="reference-pagination"></div>
        </div>
      </div>
       <div class="reference-description-container">
         <h2 class="reference-heading"><?php the_field('reference_description_title') ?></h2>
        <div class="reference-description"><?php the_content(); ?></div>
      </div>
    </div>
    <div class="reference-product">
      <h3 class="heading-18">
         <?php
          $count = count(get_field('reference_product'));
          if( $count > 1 ){
              echo 'Les produits';
          }
          else {
               echo 'Le produit';
          };?>
      </h3>
    <div class="main-wrapper">
        <?php
          $featured_posts = get_field('reference_product');
          if( $featured_posts ): ?>
          
              <?php foreach( $featured_posts as $post ): 
                  setup_postdata($post);
                  $fdp = get_field('taxo_product_link2', $post->taxonomy."_".$post->term_id);
                  $featured_post=$fdp[0];
                  ?>
                  
                   <?php if($featured_post): 
                     $permalink = get_permalink( $featured_post->ID );
                     $title = get_the_title( $featured_post->ID );
                     $logo = get_field( 'product_logo_name', $featured_post->ID );
                     $product_img = get_the_post_thumbnail_url($featured_post->ID, 'full');
                     $product = new WC_Product($featured_post);
                	   $terms = get_the_terms( $featured_post, 'gamme' );
                	   $color;
                	   if( $terms && ! is_wp_error( $terms ) ){
                          foreach( $terms as $term ){
                              $color = get_field( 'gamme_color', 'gamme_' . $term->term_id );
                          }
                      }
                   ?> 
                    <div class="reference-product-container">
                     <div class="reference-product-col">
                        <div class="reference-product-inner">
                          <div class="reference-product-dot" style="background-color:<?php echo $color; ?> ;"></div>
                          <img src="<?php echo $logo ?>" loading="lazy" alt="" class="reference-product-logo">
                          <img src="<?php echo $product_img ?>" loading="lazy" alt="" class="reference-product-img">
                        </div>
                    </div>
                    <div class="reference-product-col">
                      <h3 class="heading-19"><?php special_title($title); ?></h3>
                      <div class="text-block-100">
                        <?php echo $product->get_short_description(); ?>
                        </div>
                      <div class="reference-product-btn">
                        <a href="<?php echo $permalink ?>" class="btn-arrow-blue w-inline-block">
                          <div class="btn-arrow-picto w-embed">
                            <!--?xml version="1.0" encoding="UTF-8"?-->
                            <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill: #FFF;">
                              <g id="icon/shop" stroke="none" stroke-width="1">
                                <path d="M19.7777778,10.7777778 L10.6666667,10.7777778 L10.6666667,6.59759521 L19.7777778,6.59759521 L19.7777778,10.7777778 Z M41.2551931,5.82233181 L37.0568848,6.42553711 L34.7335514,8.74887044 C34.5402181,8.554426 33.6122222,7.77777778 33.0011111,7.77777778 C32.39,7.77777778 27.4444444,7.77777778 27.4444444,7.77777778 C27.4444444,7.77777778 27.4444444,6.02777778 27.4444444,3.88888889 C27.4444444,1.75 25.4444444,0 23,0 L7.44444444,0 C5,0 3,2 3,4.44444444 L3,45.5555556 C3,48 5,50 7.44444444,50 L40.7777778,50 C43.2222222,50 45.2222222,48 45.2222222,45.5555556 L45.2222222,23.3333333 C45.2222222,20.8888889 45.2222222,20.61 45.2222222,19.9988889 C45.2222222,19.3877778 44.3071463,17.9197428 44.1138129,17.7275206 L46.4360352,15.4030762 L46.934082,11.5012207 L41.2551931,5.82233181 Z M41.1111111,43.9512195 C41.1111111,45.0821463 40.2151111,46 39.1111111,46 L9.11111111,46 C8.00811111,46 7.11111111,45.0821463 7.11111111,43.9512195 L7.11111111,6.04878049 C7.11111111,4.91887805 8.00811111,4 9.11111111,4 L21.1111111,4 C22.1761111,4 23.1111111,4.71809756 23.1111111,5.53658537 C23.1111111,5.83365854 23.1111111,11.1707317 23.1111111,11.1707317 L32.6121111,11.1707317 L41.1111111,19.8770244 L41.1111111,43.9512195 Z M43.4532444,13.6641873 L41.7143555,15.4030762 C40.1721332,13.8608539 38.599107,12.3211111 37.0568848,10.7777778 L39.1111111,8.875 L44.1138129,13.2458496 L43.4532444,13.6641873 Z" id="Shape"></path>
                              </g>
                            </svg>
                          </div>
                          <div class="btn-text"><?php _e('Découvrir le produit', 'guard-industrie') ?></div>
                        </a>
                      </div>
                    </div>
                  </div>
                   <?php endif; ?>
              <?php wp_reset_postdata(); endforeach; ?>
          <?php endif; ?>
    </div>
  </div>
    <div class="section-related-reference">
    <div class="title-container">
      <div class="slider-reference-related-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1616076940153" loading="lazy" alt="" class="image-40"></div>
      <h2 class="main-title-black"><?php _e('Voir aussi', 'guard-industrie') ?></h2>
      <div class="slider-reference-related-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1616076940153" loading="lazy" alt="" class="image-41"></div>
    </div>
    <div class="reference-container">
      <div class="swiper-container reference-related-slider">
        <div class="swiper-wrapper">
           <?php 
          $universe_array = [];
          foreach($univers as $univer){
              array_push($universe_array, $univer->slug);
          }
          $args = array(
              'post_type' => 'reference',
              'posts_per_page' => 10,
              'orderby' => 'rand',
              'tax_query' => array(
                    array(
                        'taxonomy' => 'univers',
                        'field'    => 'slug',
                        'terms'    => $universe_array
                    )
                )
            
          );
          $references = new WP_Query( $args );
          
          if( $references->have_posts() ) : 
            while( $references->have_posts() ) : $references->the_post();?>
            
             <a href="<?php the_permalink(); ?>" class="swiper-slide reference-related-slide w-inline-block">
               <div class="reference-related-slide-box">
                <img src="<?php echo get_field('reference_gallery', $post->ID)[0]['url'] ?>" loading="lazy" alt="" class="reference-related-slide-inside">
                <div class="reference-related-text-block">
                  <div class="reference-related-city"><?php echo get_field('reference_city', $post->ID) ?></div>
                  <div class="reference-related-name"><?php the_title(); ?></div>
                  <div class="reference-related-btn-container">
                    <div class="link-arrow-white">
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
                      <div class="btn-text"><?php _e('decouvrir', 'guard-industrie') ?></div>
                    </div>
                  </div>
                </div>
            </div>
            </a>
         <?php  
          endwhile;
          endif;
          wp_reset_postdata();?>
        </div>
      </div>
    </div>
    <div class="related-reference-btn-container">
      <a href="<?php echo home_url().'/references/'.get_u_slug() ?>" class="btn-arrow-border-white w-inline-block">
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
        <div class="btn-text"><?php _e('Toutes les références', 'guard-industrie') ?></div>
      </a>
    </div>
  </div>