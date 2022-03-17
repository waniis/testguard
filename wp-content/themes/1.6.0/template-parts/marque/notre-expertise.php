<?php if( have_rows('main_content') ): ?>
  <div class="marque-informations">
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

<?php if( have_rows('logo_list') ): ?>
  <div class="section-partners white">
    <ul role="list" class="partners-list w-list-unstyled">
      <?php while( have_rows('logo_list') ): the_row(); ?>
          <li class="partners-item">
            <a href="<?php the_sub_field('logo_link'); ?>" class="partners-link w-inline-block" target="_blank">
              <img src="<?php the_sub_field('logo_img'); ?>" loading="lazy" alt="" class="partners-img">
            </a>
          </li>
      <?php endwhile; ?>
    </ul>
  </div>
<?php endif; ?>
    
<?php if(get_field('quote_text')) : ?>
  <div class="marque-quote">
    <div class="main-wrapper">
      <div class="advice-quote-container">
        <div class="advice-author-col">
          <div class="advice-author-img-container">
            <div class="advice-author-img">
              <img src="<?php the_field('quote_img'); ?>" loading="lazy" alt="" class="image-43">
            </div>
          </div>
          <div class="advice-author-name"><?php the_field('quote_author'); ?></div>
          <div class="advice-author-function"><?php the_field('quote_function'); ?></div>
        </div>
        <div class="advice-quote-col">
          <div>
            <?php the_field('quote_text'); ?>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if(get_field('highlighted_content_text')) : ?>
  <div class="marque-informations">
  <div class="main-wrapper">
    <div class="advice-informations-container">
      <div class="advice-information-row">
        <div class="advice-information-text">
          <h2 class="subtitle-black advice-info-title">
             <?php the_field('highlighted_content_title'); ?>
          </h2>
          <div class="paragraph-black">
             <?php the_field('highlighted_content_text'); ?>
          </div>
        </div>
        <div class="advice-informations-img">
          <img src="<?php the_field('highlighted_content_img'); ?>" loading="lazy" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
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
          <a href="<?php echo home_url().'/references/' ?>" class="btn-arrow-border-white w-inline-block">
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