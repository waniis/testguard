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

<div class="marque-team">
  <div class="main-wrapper">
    <div class="marque-team-container">
      <div class="marque-team-intro">
        <h2 class="subtitle-black marque-team-intro-title">
           <?php the_field('bloc_slider_title'); ?>
        </h2>
        <div class="paragraph-black marque-team-text">
           <?php the_field('bloc_slider_intro'); ?>
         </div>
      </div>
      <div class="team-gallery-container">
        <div class="slider-team-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1618839363268" loading="lazy" alt="" class="image-40"></div>
        <div class="slider-team-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1618839363268" loading="lazy" alt="" class="image-41"></div>
        <div class="swiper-container team-slider">
          <div class="swiper-wrapper">
            <?php $images = get_field('bloc_slider_gallery'); if( $images ): ?>
              <?php foreach( $images as $image ): ?>
               <div class="swiper-slide team-slide">
                  <div class="swiper-slide team-slide">
                    <div class="team-slide-box">
                      <img src="<?php echo esc_url($image['url']); ?>" loading="lazy" alt="" class="team-slide-inside">
                    </div>
                  </div>
               </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="team-pagination"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="marque-extra-cta">
  <a href="/le-nuancier/" class="btn-arrow-border-white-smoke w-inline-block">

              
              
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="92px" height="92px" viewBox="0 0 222 222" version="1.1">


                    
                    <path d="M106.151596,130.647908 C106.688394,130.647908 107.009123,130.96813 107.009123,131.503237 L107.009123,131.503237 L107.009123,143.760132 C107.009123,144.296081 106.688394,144.616302 106.151596,144.616302 L106.151596,144.616302 L93.8752879,144.616302 C93.3384895,144.616302 93.018605,144.296081 93.018605,143.760132 L93.018605,143.760132 L93.018605,131.503237 C93.018605,130.96813 93.3384895,130.647908 93.8752879,130.647908 L93.8752879,130.647908 Z M124.95051,130.647908 C125.487308,130.647908 125.808037,130.96813 125.808037,131.503237 L125.808037,131.503237 L125.808037,143.760132 C125.808037,144.296081 125.487308,144.616302 124.95051,144.616302 L124.95051,144.616302 L112.674202,144.616302 C112.137404,144.616302 111.816675,144.296081 111.816675,143.760132 L111.816675,143.760132 L111.816675,131.503237 C111.816675,130.96813 112.137404,130.647908 112.674202,130.647908 L112.674202,130.647908 Z M143.74858,130.647908 C144.285379,130.647908 144.606107,130.96813 144.606107,131.503237 L144.606107,131.503237 L144.606107,143.760132 C144.606107,144.296081 144.285379,144.616302 143.74858,144.616302 L143.74858,144.616302 L131.472272,144.616302 C131.060389,144.616302 130.615589,144.288497 130.615589,143.760132 L130.615589,143.760132 L130.615589,131.503237 C130.615589,130.96813 130.936318,130.647908 131.472272,130.647908 L131.472272,130.647908 Z M105.294913,132.358565 L94.7319707,132.358565 L94.7319707,142.905646 L105.294913,142.905646 L105.294913,132.358565 Z M124.093827,132.358565 L113.530041,132.358565 L113.530041,142.905646 L124.093827,142.905646 L124.093827,132.358565 Z M142.892741,132.358565 L132.328955,132.358565 L132.328955,142.905646 L142.892741,142.905646 L142.892741,132.358565 Z M83.5166835,132.818167 C86.2200877,132.818167 88.3377403,134.932471 88.3377403,137.6316 C88.3377403,140.286067 86.1745105,142.445033 83.5166835,142.445033 C80.8588565,142.445033 78.6956267,140.286067 78.6956267,137.6316 C78.6956267,134.977976 80.8588565,132.818167 83.5166835,132.818167 Z M83.5166835,134.529666 C81.8033177,134.529666 80.4089925,135.920943 80.4089925,137.6316 C80.4089925,139.400402 81.7450802,140.734376 83.5166835,140.734376 C85.2882868,140.734376 86.6243745,139.400402 86.6243745,137.6316 C86.6243745,135.920943 85.2300493,134.529666 83.5166835,134.529666 Z M79.1610207,124.264042 L77.5565339,124.264042 L77.9051152,123.637925 C80.8380936,118.36607 85.1181319,110.59396 89.4834165,102.665952 C94.6057894,93.3643637 99.9020309,83.7459244 103.224948,77.8024469 C103.711105,76.9016136 104.51377,76.2409463 105.484396,75.9426348 C106.459242,75.6426379 107.495702,75.7446032 108.397962,76.2299914 L122.084631,83.7644635 C123.004616,84.2591213 123.685742,85.1085507 123.950765,86.0919674 C124.211568,87.0610585 124.0588,88.0764973 123.51947,88.9512073 L117.212089,100.648558 L79.1610207,124.264042 Z M126.477769,124.391288 L82.427388,124.391288 L128.942315,95.3986122 C129.80153,94.8297979 130.831237,94.678114 131.844064,94.9646279 C132.921037,95.272209 133.741427,95.8932699 134.152466,96.7140479 L142.444143,109.956888 C142.99951,110.857721 143.170847,111.895912 142.927768,112.8827 C142.687222,113.864431 142.057581,114.709647 141.157009,115.263293 L126.477769,124.391288 Z M71.8433452,125.681443 L71.7133658,75.7083676 C71.7133658,73.5738392 73.4512082,71.8387449 75.5882733,71.8387449 L91.1891861,71.8387449 C92.1944169,71.8387449 93.1886755,72.2558754 93.917911,72.983115 C94.6463025,73.7103547 95.0640936,74.703041 95.0640936,75.7066822 L95.0640936,88.9663757 L75.5967135,124.237919 L75.3789557,124.261514 C74.0968855,124.403928 73.2376705,124.686229 72.508435,125.20701 L71.8433452,125.681443 Z M145.411727,149.288501 L75.7157207,149.288501 C73.5794996,149.288501 71.8408132,147.553407 71.8408132,145.419721 L71.8408132,129.843479 C71.8408132,127.710636 73.5794996,125.974699 75.7157207,125.974699 L145.411727,125.974699 C147.547948,125.974699 149.28579,127.710636 149.28579,129.843479 L149.28579,145.419721 C149.28579,147.553407 147.547948,149.288501 145.411727,149.288501 L145.411727,149.288501 Z M91.3174775,70 L75.463358,70.1272459 C72.4493534,70.1272459 70,72.6308715 70,75.7066822 L70.1274474,129.843479 L70.1274474,145.419721 C70.1274474,148.497217 72.6341944,151 75.7157207,151 L145.411727,151 C148.492409,151 151,148.497217 151,145.419721 L151,129.843479 C151,126.767668 148.492409,124.264042 145.411727,124.264042 L129.87918,124.264042 L142.118351,116.591369 C144.760141,114.91105 145.545926,111.577376 143.904302,109.002965 L135.71644,95.7179909 C134.897738,94.4328919 133.734675,93.5918894 132.265231,93.2253202 C130.821953,92.8654925 129.277392,93.1275684 128.134585,93.9272792 L120.215966,98.8881826 L125.220175,89.8040074 C126.633913,87.0998221 125.677635,83.7450817 123.085642,82.3335796 L109.272369,74.6710188 C106.562213,73.2595167 103.204691,74.2151247 101.790953,76.8021764 L96.9057508,85.7944986 L96.9057508,75.5794363 C96.9057508,74.0861934 96.3453198,72.7682296 95.2396503,71.6643085 C94.1331367,70.5603874 92.8139295,70 91.3174775,70 L91.3174775,70 Z" id="Fill-3" fill="#002A5D"/>

</svg>
              

            <div class="btn-text">découvrir le nuancier</div>
          </a>
          </div>
</div>

<div class="expertise-finition">
  <div class="main-wrapper">
    <div class="expertise-finition-intro">
      <h2 class="main-title-white">
        <?php the_field('bloc_finition_title'); ?>
      </h2>
      <div class="paragraph-white">
        <?php the_field('bloc_finition_text'); ?>
      </div>
    </div>
    
  <?php if( have_rows('finition') ): ?>
     <ul role="list" class="expertise-finition-list w-list-unstyled">
        <?php while( have_rows('finition') ): the_row(); ?>
          <li class="expertise-finition-item">
            <div class="gamme-item-img"><img src="<?php the_sub_field('finition_img') ?>" loading="lazy" alt="" class="image-49"></div>
            <div class="gamme-item-title"><?php the_sub_field('finition_text') ?></div>
          </li>
        <?php endwhile; ?>
      </ul>
  <?php endif; ?>

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
      <h2 class="main-title-black">Nos protections colorées</h2>
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
      <a href="/produits-prescripteurs/lasures-de-beton-colorees/" class="btn-arrow-border-white w-inline-block">
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