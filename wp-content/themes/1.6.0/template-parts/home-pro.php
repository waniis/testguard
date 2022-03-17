
   <?php if( get_field('promo_choice') ) :  ?>
      <div class="section-landing">
       <?php while( have_rows('promo_group_pro') ): the_row(); ?>
          <div class="main-wrapper">
      <div class="section-landing-container">
        <div class="section-landing-col">
          <div class="section-landing-img-container">
            <img src="<?php echo get_sub_field('promo_img');?>" loading="lazy" alt="" class="image-47">
            <?php if( get_sub_field('promo_chip_pourcentage') ) :  ?>
            <div class="promo-circle" style="background-color:<?php echo get_sub_field('promo_chip_color'); ?>;">
              <div class="promo-text">
                <?php echo get_sub_field('promo_chip_pourcentage'); ?>
                </div>
            </div>
              <?php endif;  ?>
          </div>
        </div>
        <div class="section-landing-col">
          <h2 class="main-title-black">
            <?php echo get_sub_field('promo_title'); ?>
          </h2>
          <div class="subtitle-black section-landing-subtitle">
            <?php echo get_sub_field('promo_subtitle'); ?>
          </div>
          <div class="paragraph-black section-landing-paragraph">
          <?php echo get_sub_field('promo_text'); ?>  
          </div>
          <div class="section-landing-btn-container">
            <a href="<?php the_field('storelocator_link_pro','options') ?>" class="btn-arrow-blue w-inline-block">
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
              <div class="btn-text">trouver un distributeur</div>
            </a>
          </div>
        </div>
      </div>
    </div>
      <?php endwhile; ?>
  </div>
  <?php endif;?>
  
  
  <div class="section-bestseller-products">
    <div class="title-container">
      <div class="slider-product-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1617264019169" loading="lazy" alt="" class="image-40"></div>
      <h2 class="main-title-black"><?php _e('Meilleures ventes', 'guard-industrie') ?></h2>
      <div class="slider-product-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1617264019169" loading="lazy" alt="" class="image-41"></div>
    </div>
    <div class="product-container">
      <div class="swiper-container product-slider">
        <div class="swiper-wrapper"><?php bestsellerList(); ?></div>
      </div>
    </div>
    <div class="related-products-btn-container">
      <a href="<?php the_field('catalogue_pro', 'option'); ?>" class="btn-arrow-border-white w-inline-block">
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
  
  <div class="section-storelocator">
    <?php include( locate_template( 'template-parts/components/section-storelocator.php', false, false ) ); ?>
  </div>
  
  <div class="section-partners">
    <h2 class="main-title-white"><?php _e('Nos Partenaires e-commerce', 'guard-industrie') ?></h2>
    <ul role="list" class="partners-list w-list-unstyled"><?php partners_List(); ?></ul>
  </div>
  
    <?php
    $best_advices = get_field('section_best_advices');
    $url_service = get_field('section_advice_link');
    if( $best_advices ): ?>
    
      <div class="slider-advice-container">
    
        <div class="main-wrapper">
          <div class="swiper-container advice-slider">
            <div class="swiper-wrapper">
               <?php foreach( $best_advices as $post ): setup_postdata($post); ?>
                  <div class="swiper-slide advice-slide">
                    <div class="advice-slide-container">
                      <div class="advice-slide-col advice-text-container">
                        <div class="advice-slide-text">
                          <div class="advice-navigation">
                            <div class="advice-btn-previous">
                              <div class="html-embed-3 w-embed">
                                <!--?xml version="1.0" encoding="UTF-8"?-->
                                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                                  <defs>
                                    <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                                  </defs>
                                  <g id="icon/chevron" stroke="none" stroke-width="1">
                                    <mask id="mask-2" fill="white">
                                      <use xlink:href="#path-prev"></use>
                                    </mask>
                                    <use id="icon-copy" xlink:href="#path-prev"></use>
                                  </g>
                                </svg>
                              </div>
                            </div>
                            <div class="advice-btn-next">
                              <div class="html-embed-3 w-embed">
                                <!--?xml version="1.0" encoding="UTF-8"?-->
                                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                                  <defs>
                                    <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                                  </defs>
                                  <g id="icon/chevron" stroke="none" stroke-width="1">
                                    <mask id="mask-2" fill="white">
                                      <use xlink:href="#path-prev"></use>
                                    </mask>
                                    <use id="icon-copy" xlink:href="#path-prev"></use>
                                  </g>
                                </svg>
                              </div>
                            </div>
                          </div>
                          <h2 class="main-title-white advice-slide-title">Nos meilleurs conseils</h2>
                          <div class="subtitle-white">
                            <?php the_title();?>
                          </div>
                          <div class="paragraph-white advice-slide-paragraph">
                           <?php the_field('advice_text_intro');?> 
                          </div>
                          <div class="advice-slide-link-container">
                            <a href="<?php the_permalink();?>" class="link-arrow-white">
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
                              <div class="btn-text"><?php _e('EN SAVOIR PLUS', 'guard-industrie') ?></div>
                            </a>
                          </div>
                          <div class="advice-slide-btn-container">
                            <a href="<?php echo esc_url( $url_service ) ?>" class="btn-arrow-border-transparent w-inline-block">
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
                              <div class="btn-text"><?php _e('tous les conseils', 'guard-industrie') ?></div>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="advice-slide-col advice-img-container">
                        <div class="advice-slide-img-container">
                          <img src="<?php the_post_thumbnail_url('full') ?>" loading="lazy" alt="" class="advice-slide-img">
                          </div>
                      </div>
                    </div>
                  </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="advice-slide-pagination"></div>
        </div>
        
      </div>

      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  
   <div class="section-engagement">
    <div class="main-wrapper">
      <div class="engagement-container">
        <div class="engagement-img-col">
          <div class="engagement-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/engagement-1.svg?v=1617021621815" loading="lazy" alt="" class="engagement-img">
            <div class="engagement-text"><?php _e('chimie verte', 'guard-industrie') ?></div>
          </div>
          <div class="engagement-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/engagement-2.svg?v=1617021621815" loading="lazy" alt="" class="engagement-img">
            <div class="engagement-text"><strong><?php _e('Chimie non dangereuse', 'guard-industrie') ?></strong></div>
          </div>
          <div class="engagement-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/engagement-3.svg?v=1617021621815" loading="lazy" alt="" class="engagement-img">
            <div class="engagement-text"><strong><?php _e('Chimie innovante', 'guard-industrie') ?></strong></div>
          </div>
        </div>
        <div class="engagement-text-col">
          <h2 class="main-title-black"><?php _e('Nos engagements', 'guard-industrie') ?></h2>
          <div class="paragraph-black engagement-paragraph">L’écologie, la sécurité et la performance font partie intégrante de notre ADN. Découvrez comment ces valeurs fondamentales guident notre quotidien.</div>
          <div class="engagement-btn-container">
            <a href="<?php the_field('section_engagement_link'); ?>" class="btn-arrow-blue w-inline-block">
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
              <div class="btn-text"><?php _e('découvrir', 'guard-industrie') ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php $video = get_field('section_video'); if( $video ): ?>
    <div class="slider-video-container">
    <div class="main-wrapper">
      <div class="slider-video-top">
        <div class="div-block-309">
          <h2 class="main-title-white video-slide-title"><?php _e('Nos vidéos', 'guard-industrie') ?></h2>
          <div class="video-btn-container">
            <a href="<?php the_field('section_video_link'); ?>" class="btn-arrow-border-blue w-inline-block">
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
              <div class="btn-text"><?php _e('TOUTES les vidéos', 'guard-industrie') ?></div>
            </a>
          </div>
        </div>
        <div class="video-navigation">
          <div class="video-btn-previous">
            <div class="html-embed-3 w-embed">
              <!--?xml version="1.0" encoding="UTF-8"?-->
              <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                <defs>
                  <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                </defs>
                <g id="icon/chevron" stroke="none" stroke-width="1">
                  <mask id="mask-2" fill="white">
                    <use xlink:href="#path-prev"></use>
                  </mask>
                  <use id="icon-copy" xlink:href="#path-prev"></use>
                </g>
              </svg>
            </div>
          </div>
          <div class="video-btn-next">
            <div class="html-embed-3 w-embed">
              <!--?xml version="1.0" encoding="UTF-8"?-->
              <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                <defs>
                  <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                </defs>
                <g id="icon/chevron" stroke="none" stroke-width="1">
                  <mask id="mask-2" fill="white">
                    <use xlink:href="#path-prev"></use>
                  </mask>
                  <use id="icon-copy" xlink:href="#path-prev"></use>
                </g>
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-container video-slider">
        <div class="swiper-wrapper">
            <?php foreach( $video as $post ): setup_postdata($post); $terms = wp_get_post_terms($post->ID,'gamme'); ?>
                 <a href="<?php the_permalink();?>" class="swiper-slide video-slide w-inline-block">
                    <div class="video-slide-img-container">
                      <div class="video-slide-bg" style="background:<?php echo get_field( 'gamme_color', 'gamme_' . $terms[0]->term_id ); ?>;"></div>
                      <img src="<?php the_post_thumbnail_url('full') ?>" loading="lazy" alt="" class="image-46">
                    </div>
                    <div class="video-slide-gamme"></div>
                    <div class="subtitle-white"><?php the_title(); ?></div>
                 </a>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if( have_rows('verbatims') ): ?>
    <div class="slider-testimony-container">
      <div class="main-wrapper">
        <div class="swiper-container testimony-slider">
          <div class="swiper-wrapper">
              <?php while( have_rows('verbatims') ) : the_row(); ?>
                  <div class="swiper-slide testimony-slide">
                    <div class="testimony-slide-text">
                      <div class="testimony-navigation">
                        <div class="testimony-btn-previous">
                          <div class="html-embed-3 w-embed">
                            <!--?xml version="1.0" encoding="UTF-8"?-->
                            <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                              <defs>
                                <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                              </defs>
                              <g id="icon/chevron" stroke="none" stroke-width="1">
                                <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-prev"></use>
                                </mask>
                                <use id="icon-copy" xlink:href="#path-prev"></use>
                              </g>
                            </svg>
                          </div>
                        </div>
                        <div class="testimony-btn-next">
                          <div class="html-embed-3 w-embed">
                            <!--?xml version="1.0" encoding="UTF-8"?-->
                            <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#FFF;">
                              <defs>
                                <path d="M22.7751805,11.5731854 C20.2792296,9.04305209 18.2753154,5.355059 16.763438,0.509206101 C15.4946813,-0.775538949 11.7422711,0.621878697 11.2425453,1.92882237 C10.7428195,3.23576603 11.2425453,2.76808648 11.2425453,4.78370644 C12.9714972,10.1807121 14.8117948,13.8683172 16.763438,15.8465218 C18.4226493,17.5283144 22.3344841,20.5794739 28.4989425,25 C22.4693165,30.7488514 18.5574816,34.5325837 16.763438,36.351197 C14.9469313,38.192581 13.1066337,40.9773747 11.2425453,44.7055781 C10.3928867,45.9175882 10.6074158,46.4919552 11.2425453,47.9774169 C11.8776748,49.4628785 15.4946813,50.9264311 16.763438,49.6402987 C18.9159377,45.6838183 20.9198518,42.4018563 22.7751805,39.7944126 C24.6305092,37.1869689 29.7971437,33.0721662 38.275084,27.4500046 C38.91699,26.7993076 39.2263093,25.9377237 39.2126227,25.0747524 C39.2263093,24.2131685 38.91699,23.3501972 38.275084,22.6995002 C30.3104199,17.6830002 25.1437854,13.9742286 22.7751805,11.5731854 Z" id="path-prev"></path>
                              </defs>
                              <g id="icon/chevron" stroke="none" stroke-width="1">
                                <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-prev"></use>
                                </mask>
                                <use id="icon-copy" xlink:href="#path-prev"></use>
                              </g>
                            </svg>
                          </div>
                        </div>
                      </div>
                      <h2 class="main-title-white testimony-slide-title">Ils en parlent</h2>
                      <div class="html-embed-4 w-embed">
                        <!--?xml version="1.0" encoding="UTF-8"?-->
                        <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
                          <g id="icon/quote">
                            <path d="M38.6360215,8 C32.3602151,8 27.2725806,13.0876344 27.2725806,19.3634409 C27.2725806,25.5629032 32.2376344,30.5989247 38.4080645,30.722043 C35.5387097,33.5349462 31.6091398,35.2725806 27.2725806,35.2725806 L27.2725806,42.0913978 C39.8241935,42.0913978 50,31.9150538 50,19.3639785 C50,13.0876344 44.911828,8 38.6360215,8 Z M11.3634409,8 C5.08763441,8 0,13.0876344 0,19.3639785 C0,25.5634409 4.96505376,30.5994624 11.1354839,30.7225806 C8.26612903,33.5354839 4.33655914,35.2725806 0,35.2725806 L0,42.0913978 C12.5521505,42.0913978 22.7268817,31.9150538 22.7268817,19.3639785 C22.7268817,13.0876344 17.6397849,8 11.3634409,8 Z" id="Shape"></path>
                          </g>
                        </svg>
                      </div>
                      <div class="paragraph-white testimony-slide-paragraph">
                        <?php the_sub_field('verbatim_text'); ?>
                      </div>
                      <div class="testimony-slide-author">
                        <?php the_sub_field('verbatim_author'); ?>
                      </div>
                    </div>
                    <div class="testimony-slide-pagination"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony.jpg?v=1617264019169" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 767px) 85vw, (max-width: 991px) 86vw, 87vw" srcset="<?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-500.jpeg?v=1617264019169 500w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-800.jpeg?v=1617264019169 800w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-1080.jpeg?v=1617264019169 1080w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony.jpg?v=1617264019169 1274w" alt="" class="testimony-bg">
                  </div>
                <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>