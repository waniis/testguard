<div class="expertise-intro">
  <div class="expertise-info-intro">
    <?php if(get_field('expertise_intro_title')) : ?>
      <h2 class="main-title-black">
        <?php the_field('expertise_intro_title'); ?>
      </h2>
    <?php endif; ?>
     <?php if(get_field('expertise_intro_text')) : ?>
      <div class="expertise-intro-text">
        <?php the_field('expertise_intro_text'); ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="main-wrapper">
    <div class="advice-intro-container">
      <div class="advice-intro-text">
        <h2 class="subtitle-black advice-info-title">
          <?php the_field('expertise_title'); ?>
        </h2>
        <div class="paragraph-black">
          <?php the_field('expertise_text'); ?>
        </div>
      </div>
      <div class="advice-intro-img">
        <img src="<?php the_field('expertise_img'); ?>" loading="lazy" alt="" class="image-44">
      </div>
    </div>
  </div>
</div>

<?php if( have_rows('main_content') ): ?>
  <div class="expertise-informations">
    <div class="main-wrapper">
       <div class="marque-info-intro">
        <h2 class="main-title-black">
          <?php the_field('main_content_title'); ?>
        </h2>
      </div>
      <div class="advice-informations-container">
        <?php while( have_rows('main_content') ): the_row(); ?>
            <div class="advice-information-row">
              <div class="advice-information-text">
                <h2 class="subtitle-black advice-info-title">
                  <?php the_sub_field('main_content_title'); ?>
                </h2>
                <div class="paragraph-black">
                  <?php the_sub_field('main_content_text'); ?>
                </div>
              </div>
              <?php if(get_sub_field('main_content_img')) : ?>
              <div class="advice-informations-img">
                <img src="<?php the_sub_field('main_content_img'); ?>" loading="lazy" alt="" class="image-45">
              </div>
              <?php endif; ?>
            </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
    
<div class="section-related-products">
    <div class="title-container">
      <div class="slider-product-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-40"></div>
      <h2 class="main-title-black">Nos protections incolores</h2>
      <div class="slider-product-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-41"></div>
    </div>
    <div class="product-container">
      <div class="swiper-container product-slider">
        <div class="swiper-wrapper">
          <?php
            $product_related = get_field('expertise-related-products');
            if( $product_related ): ?>
                <?php foreach( $product_related as $post ): 
                    setup_postdata($post); 
                    global $product; 
                	   $terms = get_the_terms( $post, 'gamme' );
                	   $color;
                	   if( $terms && ! is_wp_error( $terms ) ){
                          foreach( $terms as $term ){
                              $color = get_field( 'gamme_color', 'gamme_' . $term->term_id );
                          }
                      }
                    ?>
                    
                    <a href="<?php the_permalink(); ?>" class="swiper-slide product-slide w-inline-block">
                      <div class="product-card">
                        <div class="img-container">
                            <img src="<?php the_field('product_logo_name', $post) ?>" loading="lazy" alt="" class="img-title">
                            <img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" loading="lazy" alt="" class="img-product">
                            <div class="color-dot" style="background-color:<?php echo $color;?>;">
                              <div class="dot-cross-line"></div>
                              <div class="dot-cross-line vertical"></div>
                            </div>
                        </div>
                      
                      </div>
                      <div class="product-hover" style="background-color:<?php echo $color;?>;">
                        <div class="product-function"><?php echo $term->name;?></div>
                        <div class="product-name"><?php special_title(get_the_title()); ?></div>
                        <div class="product-short-description"><?php echo $product->get_short_description() ?></div>
                        <div class="product-card-btn-container">
                          <div class="btn-picto-white">
                            <div class="btn-arrow-picto w-embed">
                              <!--?xml version="1.0" encoding="UTF-8"?-->
                              <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill: #003a80;">
                                <g id="icon/shop" stroke="none" stroke-width="1">
                                  <path d="M19.7777778,10.7777778 L10.6666667,10.7777778 L10.6666667,6.59759521 L19.7777778,6.59759521 L19.7777778,10.7777778 Z M41.2551931,5.82233181 L37.0568848,6.42553711 L34.7335514,8.74887044 C34.5402181,8.554426 33.6122222,7.77777778 33.0011111,7.77777778 C32.39,7.77777778 27.4444444,7.77777778 27.4444444,7.77777778 C27.4444444,7.77777778 27.4444444,6.02777778 27.4444444,3.88888889 C27.4444444,1.75 25.4444444,0 23,0 L7.44444444,0 C5,0 3,2 3,4.44444444 L3,45.5555556 C3,48 5,50 7.44444444,50 L40.7777778,50 C43.2222222,50 45.2222222,48 45.2222222,45.5555556 L45.2222222,23.3333333 C45.2222222,20.8888889 45.2222222,20.61 45.2222222,19.9988889 C45.2222222,19.3877778 44.3071463,17.9197428 44.1138129,17.7275206 L46.4360352,15.4030762 L46.934082,11.5012207 L41.2551931,5.82233181 Z M41.1111111,43.9512195 C41.1111111,45.0821463 40.2151111,46 39.1111111,46 L9.11111111,46 C8.00811111,46 7.11111111,45.0821463 7.11111111,43.9512195 L7.11111111,6.04878049 C7.11111111,4.91887805 8.00811111,4 9.11111111,4 L21.1111111,4 C22.1761111,4 23.1111111,4.71809756 23.1111111,5.53658537 C23.1111111,5.83365854 23.1111111,11.1707317 23.1111111,11.1707317 L32.6121111,11.1707317 L41.1111111,19.8770244 L41.1111111,43.9512195 Z M43.4532444,13.6641873 L41.7143555,15.4030762 C40.1721332,13.8608539 38.599107,12.3211111 37.0568848,10.7777778 L39.1111111,8.875 L44.1138129,13.2458496 L43.4532444,13.6641873 Z" id="Shape"></path>
                                </g>
                              </svg>
                            </div>
                            <div class="btn-text">Découvrir</div>
                          </div>
                        </div>
                      </div>
                    </a>
                <?php endforeach; ?>
                <?php 
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="related-products-btn-container">
      <a href="/produits-prescripteurs/lasures-de-protection-incolore/" class="btn-arrow-border-white w-inline-block">
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
        <div class="btn-text"><?php _e('Tous les produits', 'guard-industrie') ?></div>
      </a>
    </div>
  </div>