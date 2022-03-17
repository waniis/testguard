<div class="home-col-gamme">
  <div class="main-wrapper">
    <div class="home-col-gamme-container">
      <?php if( have_rows('bloc_produit_1') ): ?>
          <?php while( have_rows('bloc_produit_1') ): the_row(); ?>
              <div class="home-gamme-col">
               <a href="<?php the_sub_field('bloc_produit_link') ?>" class="home-gamme-col-bg" style="background-image:url('<?php the_sub_field('bloc_produit_img') ?>');"></a>
                <div class="home-gamme-content">
                  <h2 class="home-gamme-title">
                    <?php the_sub_field('bloc_produit_title') ?>
                    </h2>
                  <div class="home-gamme-subtitle">
                    <?php the_sub_field('bloc_produit_description') ?>
                  </div>
                  <div class="home-col-btn-container">
                    <a href="<?php the_sub_field('bloc_produit_link') ?>" class="btn-arrow-all-white w-inline-block">
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
                      <div class="btn-text"><?php _e('Voir nos solutions', 'guard-industrie') ?></div>
                    </a>
                  </div>
                </div>
              </div>
          <?php endwhile; ?>
      <?php endif; ?>
      <?php if( have_rows('bloc_produit_2') ): ?>
          <?php while( have_rows('bloc_produit_2') ): the_row(); ?>
              <div class="home-gamme-col">
               <a href="<?php the_sub_field('bloc_produit_link') ?>" class="home-gamme-col-bg" style="background-image:url('<?php the_sub_field('bloc_produit_img') ?>');"></a>
                <div class="home-gamme-content">
                  <h2 class="home-gamme-title">
                    <?php the_sub_field('bloc_produit_title') ?>
                    </h2>
                  <div class="home-gamme-subtitle">
                    <?php the_sub_field('bloc_produit_description') ?>
                  </div>
                  <div class="home-col-btn-container">
                    <a href="<?php the_sub_field('bloc_produit_link') ?>" class="btn-arrow-all-white w-inline-block">
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
                      <div class="btn-text"><?php _e('Voir nos solutions', 'guard-industrie') ?></div>
                    </a>
                  </div>
                </div>
              </div>
          <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php if( have_rows('section_nuancier') ): ?>
    <?php while( have_rows('section_nuancier') ): the_row(); 
    ?>
    <div class="nuancier-section">
      <div class="main-wrapper">
        <div class="engagement-container">
          <div class="engagement-img-col">
            <?php if( have_rows('nuance') ): ?>
            <div class="swiper-container nuance-slider">
              <div class="swiper-wrapper nuance-wrapper">
                  <?php while( have_rows('nuance') ): the_row(); 
                  $image = get_sub_field('image');
                  ?>
                <div class="swiper-slide nuance-slide">
                  <div class="nuance-item"><img src="<?php echo $image; ?>" loading="lazy" alt="" class="engagement-img">
                    <div class="engagement-text"><?php the_sub_field('nom'); ?></div>
                  </div>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="slider-nuance-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1618839363268" loading="lazy" alt="" class="image-40"></div>
            <div class="slider-nuance-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1618839363268" loading="lazy" alt="" class="image-41"></div>
            <?php endif; ?>
          </div>
          <div class="engagement-text-col">
            <h2 class="main-title-black"><?php the_sub_field('titre'); ?></h2>
            <div class="paragraph-black engagement-paragraph"><?php the_sub_field('texte'); ?></div>
            <div class="engagement-btn-container">
              <a href="<?php the_sub_field('bouton_cta'); ?>" class="btn-arrow-blue w-inline-block">
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
                <div class="btn-text"><?php _e('découvrir le nuancier', 'guard-industrie') ?></div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>    
<div class="content-wrapper">
  <div class="main-wrapper">
    <div class="content-inner white">
        <?php the_content(); ?>
    </div>
  </div>
</div>

<div class="section-documentation"><?php include( locate_template( 'template-parts/components/section-documents.php', false, false ) ); ?></div>

<div class="prescripteurs-ressources">
  <div class="main-wrapper">
    <div class="prescripteurs-ressources-intro">
      <h2 class="main-title-black ressource-title">
        <?php the_field('resource_title') ?>
      </h2>
      <div class="paragraph-black">
        <?php the_field('resource_subtitle') ?>
      </div>
    </div>
    <ul role="list" class="ressources-list w-list-unstyled">
      <?php if( have_rows('resources') ): ?>
    <?php while( have_rows('resources') ): the_row() ?>
         <li class="ressource-item">
          <a href="<?php the_sub_field('resources_link'); ?>" class="ressource-item-img">
            <img src="<?php the_sub_field('resources_img'); ?>" loading="lazy" alt="" class="image-49">
          </a>
          <div class="ressource-item-title">
            <?php the_sub_field('resources_text'); ?>
          </div>
        </li>
    <?php endwhile; ?>
<?php endif; ?>
     
    </ul>
  </div>
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
                <div class="advice-slide-container advice-text-container">
                  <div class="advice-slide-col">
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

<?php
  $featured_posts = get_field('verbatims');
  if( $featured_posts ): ?>
    <div class="slider-testimony-container">
      <div class="main-wrapper">
        <div class="swiper-container testimony-slider">
          <div class="swiper-wrapper">
            <?php foreach( $featured_posts as $post ): 
                    setup_postdata($post); ?>
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
                          <h3><?php the_title(); ?></h3>
                      </div>
                      <div class="testimony-slide-author">
                        <?php the_field('testimony_quote_author'); ?>
                      </div>
                      <div class="testimony-slide-btn-container">
                        <a href="<?php the_permalink(); ?>" class="btn-arrow-all-white w-inline-block">
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
                          <div class="btn-text">Lire le témoignage</div>
                        </a>
                        <a href="/temoignages" class="btn-arrow-white w-inline-block">
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
                          <div class="btn-text">Tous les témoignages</div>
                        </a>
                      </div>
                    </div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony.jpg?v=1617264019169" loading="lazy" sizes="(max-width: 479px) 100vw, (max-width: 767px) 85vw, (max-width: 991px) 86vw, 87vw" srcset="<?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-500.jpeg?v=1617264019169 500w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-800.jpeg?v=1617264019169 800w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony-p-1080.jpeg?v=1617264019169 1080w, <?php echo get_stylesheet_directory_uri(); ?>/images/img-testimony.jpg?v=1617264019169 1274w" alt="" class="testimony-bg">
                  </div>
                <?php endforeach; ?>
          </div>
        </div>
        <div class="testimony-slide-pagination"></div>
      </div>
    </div>
<?php 
    wp_reset_postdata(); ?>
<?php endif; ?>

<?php $featured_reference = get_field('references_related'); if( $featured_reference ): ?>
  <div class="section-reference">
    <div class="section-reference-wrapper white">
      <div class="main-wrapper">
        <h2 class="main-title-black">Nos références</h2>
        <div class="reference-list">
          <div class="reference-col-highlight <?php if( !isset($featured_reference[2]) ): ?>col-half<?php endif; ?>">
            <div class="reference-item">
              <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>" class="reference-img">
               <img src="<?php echo get_field('reference_gallery', $featured_reference[0])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
              </a>
              <div class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[0]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[0]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>" class="link-arrow-white w-inline-block">
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
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($featured_reference[1])): ?>
          <div class="reference-col <?php if( !isset($featured_reference[2]) ): ?>col-half<?php endif; ?>">
            <div class="reference-item">
               <a href="<?php echo get_the_permalink($featured_reference[1]->ID); ?>" class="reference-img">
                 <img src="<?php echo get_field('reference_gallery', $featured_reference[1])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
               </a>
              <div class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[1]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[1]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <a href="<?php echo get_the_permalink($featured_reference[1]->ID); ?>" class="link-arrow-white w-inline-block">
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
                  </a>
                </div>
              </div>
            </div>
            <?php if( isset($featured_reference[2])): ?>
            <div class="reference-item">
               <a href="<?php echo get_the_permalink($featured_reference[2]->ID); ?>" class="reference-img">
                <img src="<?php echo get_field('reference_gallery', $featured_reference[2])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
               </a>
             <div class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[2]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[2]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <a href="<?php echo get_the_permalink($featured_reference[2]->ID); ?>" class="link-arrow-white w-inline-block">
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
                  </a>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="reference-btn-container">
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
            <div class="btn-text"><?php _e('toutes les références', 'guard-industrie') ?></div>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="section-documentation"><?php include( locate_template( 'template-parts/components/section-documents.php', false, false ) ); ?></div>

