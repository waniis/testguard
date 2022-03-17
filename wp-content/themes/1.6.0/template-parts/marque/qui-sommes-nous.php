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

<div class="marque-material-care">
  <div class="main-wrapper">
    <div class="marque-material-care-intro">
      <h2 class="main-title-white marque-material-title">
       <?php the_field('gamme_bloc_title'); ?>
      </h2>
      <div class="paragraph-white">
       <?php the_field('gamme_bloc_subtitle'); ?>
      </div>
    </div>
    
    <ul role="list" class="marque-gamme-list w-list-unstyled">
       <?php $ids=get_field('gamme_order');
            foreach ($ids as $id) : 
               $color = get_field( 'gamme_color', 'gamme_' . $id);
               $permalink = get_field( 'gamme_link_particulier', 'gamme_' . $id);
            ?>
            <li class="marque-gamme-item">
              <div class="gamme-item-img">
                <img src="<?php the_cat_img($id, 'full'); ?>" loading="lazy" alt="" class="image-49">
                <div class="gamme-item-hover" style="background-color:<?php echo $color;?>;"></div>
              </div>
              <div class="gamme-item-title">
                <?php echo get_term( $id )->name ?>
              </div>
            </li>
        <?php endforeach;?>
    </ul>
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
</div>

<?php if( have_rows('main_content') ): ?>
<div class="marque-keynumbers">
  <div class="main-wrapper">
    <div class="marque-keynumbers-container">
      <div class="keynumbers-title">
        <h2 class="main-title-black">
         <?php the_field('keynumbers_title'); ?>
        </h2>
      </div>
      <ul role="list" class="keynumbers-list w-list-unstyled">
        <?php while( have_rows('keynumbers') ): the_row(); ?>
        <li class="keynumbers-item">
          <img src="<?php the_sub_field('keynumbers_img'); ?>" loading="lazy" alt="" class="image-50">
          <div class="keynumbers-text">
              <?php the_sub_field('keynumbers_text'); ?>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</div>
<?php endif; ?>