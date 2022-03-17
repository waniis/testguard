  <div class="product-section-container">
    <div class="product-col">
      <div class="product-col-wrapper">
        <a href="javascript:history.back()
        <?php
        /*
        if($u_slug=="particuliers"){
        the_field('catalogue_particulier', 'option'); 
       }
        if($u_slug=="pro-du-batiment"){
        the_field('catalogue_pro', 'option'); 
       }
        if($u_slug=="prescripteurs"){
        the_field('catalogue_prescripteurs', 'option'); 
       }
        if($u_slug=="industriels"){
        the_field('catalogue_industriels', 'option'); 
       }
       */
        ?>" class="back-to-list desktop w-inline-block">
          <div class="picto-back-to-list w-embed">
            <!--?xml version="1.0" encoding="UTF-8"?-->
            <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80;">
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
          <div class="text-block-99"><?php _e('Retour', 'guard-industrie') ?></div>
        </a>
        <div class="product-add-to-cart">
          <h1 class="product-title"><?php special_title(get_the_title()); ?></h1>
          <h2 class="product-short_description"><?= strip_tags( wpautop($product->get_short_description()) , ); ?></h2>
          <div class="product-description-container <?php echo $u_slug; ?>">
            <?php if($u_slug=="particuliers"): ?>
            <div class="product-description-trigger">
              <div class="label-cross">
                <div class="line"></div>
                <div class="line second"></div>
              </div>
            <div class="product-label"><?php _e('EN SAVOIR PLUS', 'guard-industrie') ?></div>
            </div>
            <?php endif; ?>
            <div class="product-description <?php if($u_slug!="particuliers"){ echo "active"; } ?>">
              <?php echo wpautop($product->get_description()); ?>
            </div>
          </div>
          
          <?php if($u_slug=="particuliers"): ?>
           <div class="add-to-cart-container">
            <div class="product-price-container">
              
              <div class="product-price" udy-el="wcprice">
                
                <?php 
                if($product->is_type('variable')){
                  echo wc_price($product->get_variation_price('min', true));
                
                }else{
                //echo wc_price( wc_get_price_including_tax( $product ) ); 
                
                echo $product->get_price_html();
                }
                ?>
                </div>
                
             <?php if ( $product->is_on_sale() )  : ?>
              <div class="product-price-promo" >
                <?php 
                  if(! $product->is_type('variable')){
                    $price = $product->get_regular_price();
                    
                    echo wc_price( wc_get_price_including_tax( $product, array('price' => $price ) ));
                  } 
                ?>
                </div>
            <?php endif; ?>  
            
            
            <script type="application/ld+json"><?= jsonld_product($breadcrumb_data) ?></script> 
              
            </div>
              <?php if ( $product->is_type( 'simple' )) : ?>
                <div class="variations-wrapper">
                  	  <?php $featured_posts = get_field('product_conditionnement');
                        if( $featured_posts ): ?>
                            <?php foreach( $featured_posts as $post ): setup_postdata($post); ?>
                               <div class="variations-main-wrapper">
                  	              <label item="variation-title" class="variation-2 selected">
                                     <?php the_title(); ?>
                                	</label>
                              </div>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php udesly_wc_single_product_add_to_cart('ZdyP') ?>
            <div class="product-payment-block">
              <ul role="list" class="product-payment-list w-list-unstyled">
                <li class="product-payment-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/paypal.svg?v=1615475113908" loading="lazy" alt=""></li>
                <li class="product-payment-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mastercard.svg?v=1615475113908" loading="lazy" alt=""></li>
                <li class="product-payment-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/visa.svg?v=1615475113908" loading="lazy" alt=""></li>
                <li class="product-payment-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/american_express.svg?v=1615475113908" loading="lazy" alt=""></li>
              </ul>
            </div>
          </div>
          <?php elseif($u_slug=="pro-du-batiment"): ?>  
           <div class="store-locator-btn-container">
            <a href="<?php if(get_u_slug()=="particuliers"){ the_field('storelocator_link', 'option'); } else { the_field('storelocator_link_pro', 'option');}?>" class="btn-arrow-blue w-inline-block">
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
              <div class="btn-text"><?php _e('Voir les distributeurs', 'guard-industrie') ?></div>
            </a>
          </div>
          <?php else: ?>
           <div class="store-locator-btn-container">
            <a href="<?php echo home_url().'/contacter-un-commercial-'.$u_slug; ?>" class="btn-arrow-blue w-inline-block">
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
              <div class="btn-text">contacter un commercial</div>
            </a>
          </div>
          <?php endif; ?>
        </div>
        
        <?php if($u_slug=="particuliers"): ?>
        <div class="product-payment-shipping"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/delivery.svg?v=1615475113908" loading="lazy" alt="" class="image-39">
          <div class="paragraph-2"><?php the_field('product_delivery_text','options' ) ?></div>
        </div>
        <?php endif; ?>
        
        <div class="product-reinsurance-container">
            <?php
              $featured_posts = get_field('product_reinsurance');
              if( $featured_posts ): ?>
                 <ul role="list" class="product-reinsurance-list w-list-unstyled">
                  <?php foreach( $featured_posts as $post ): 
              
                      // Setup this post for WP functions (variable must be named $post).
                      setup_postdata($post); ?>
                         <li class="product-reinsurance-item">
                            <img src="<?php the_post_thumbnail_url() ?>" loading="lazy" alt="" class="product-reinsurance-img">
                            <div class="product-reinsurance-text"><?php the_title(); ?></div>
                          </li>
                  <?php endforeach; ?>
                  </ul>
                  <?php 
                  // Reset the global post object so that the rest of the page works correctly.
                  wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        
    
     
        <div class="product-dropdown-wrapper mobile">
          <div class="product-dropdown">
          <div class="product-dropdown_title">
            <div><?php _e('Les avantages', 'guard-industrie') ?></div>
            <div class="label-cross">
              <div class="line"></div>
              <div class="line second"></div>
            </div>
          </div>
          <div class="product-dropdown_container">
            <div class="product-dropdown_content">
             <?php the_field('product_advantages'); ?>
            </div>
          </div>
        </div>
          <div class="product-dropdown">
          <div class="product-dropdown_title">
            <div><?php _e('UTILISATION', 'guard-industrie') ?></div>
            <div class="label-cross">
              <div class="line"></div>
              <div class="line second"></div>
            </div>
          </div>
          <div class="product-dropdown_container">
            <div class="product-dropdown_content">
              <?php the_field('product_uses'); ?>
            </div>
          </div>
        </div>
          <?php if(get_field('product_is_conso') ): ?>
            <div class="btn-conso-container">
              <a href="<?php if($u_slug=="particuliers"){ the_field('conso_particuliers', 'option'); } if($u_slug=="pro-du-batiment"){ the_field('conso_pro', 'option'); }?>" class="link-arrow-blue">
                <div class="btn-arrow-picto w-embed">
                  <!--?xml version="1.0" encoding="UTF-8"?-->
    
                  <svg viewBox="0 0 50 37" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g>
                          <g id="icon/calculate" transform="translate(0.000000, -7.000000)">
                              <path d="M43.5732648,39.1336761 L43.5732648,43.9537275 L6.61953728,43.9537275 L6.61953728,39.1336761 L43.5732648,39.1336761 Z M47.5899743,7 C48.9209947,7 50,8.07900526 50,9.41002571 L50,9.41002571 L50,24.6735219 L45.1799486,24.6735219 L45.1799486,15.2262211 L30.0128535,30.3933162 C29.0719231,31.3330764 27.5476142,31.3330764 26.6066838,30.3933162 L26.6066838,30.3933162 L15.4562982,19.2429306 L3.40616967,31.2930591 L-1.63424829e-13,27.8868895 L13.7532134,14.1336761 C14.6941438,13.1939159 16.2184526,13.1939159 17.159383,14.1336761 L17.159383,14.1336761 L28.3097686,25.2840617 L41.7737789,11.8200514 L32.3264781,11.8200514 L32.3264781,7 Z" id="Path-conso"></path>
                          </g>
                      </g>
                  </svg>
                </div>
                <div class="btn-text">calculer ma consommation</div>
              </a>
            </div>
          <?php endif; ?>
          <?php if(get_field('product_is_nuancier') ): ?>
            <div class="btn-nuancier-container">
            <a href="<?php if($u_slug=="pro-du-batiment"){ the_field('nuancier_pro', 'option'); } if($u_slug=="prescripteurs"){the_field('nuancier_prescripteurs', 'option'); } if($u_slug=="industriels"){ the_field('nuancier_industriels', 'option'); } ?>" class="link-arrow-blue">
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
              <div class="btn-text">voir le nuancier</div>
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="product-col">
      <a href="<?php
       if($u_slug=="particuliers"){
        the_field('catalogue_particulier', 'option'); 
       }
        if($u_slug=="pro-du-batiment"){
        the_field('catalogue_pro', 'option'); 
       }    
        if($u_slug=="prescripteurs"){
        the_field('catalogue_prescripteurs', 'option'); 
       }
        if($u_slug=="industriels"){
        the_field('catalogue_industriels', 'option'); 
       }
        ?>" class="back-to-list mobile w-inline-block">
        <div class="picto-back-to-list w-embed">
          <!--?xml version="1.0" encoding="UTF-8"?-->
          <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80;">
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
        <div class="text-block-99"><?php _e('Retour à la liste', 'guard-industrie') ?></div>
      </a>
      <div class="product-visuals">
        <div class="swiper-container product-single-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide product-single-slide">
              <div class="product-featured-container">
                <img <?= rawww_image_srcset( get_field('product_logo_name') ) ?> loading="lazy"  class="product-logo">
                <img src="<?php echo udesly_woocommerce_featured_image_url('full') ?>" loading="lazy" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" class="product-featured-img" udy-el="wc-featured-image"></div>
            </div>
           <?php  $attachment_ids = $product->get_gallery_image_ids(); foreach( $attachment_ids as $attachment_id) : ?>
                   <div class="swiper-slide product-single-slide">
                     <img src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" loading="lazy" alt="" class="product-gallery">
                   </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="slider-product-single-pagination-container">
        <div class="slider-product-single-pagination"></div>
        <div class="slider-pagination-buttons">
          <div class="slider-pagination-previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-40"></div>
          <div class="slider-pagination-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-41"></div>
        </div>
      </div>
      <div class="product-dropdown-wrapper desktop">
        <div class="product-dropdown">
          <div class="product-dropdown_title">
            <div><?php _e('Les avantages', 'guard-industrie') ?></div>
            <div class="label-cross">
              <div class="line"></div>
              <div class="line second"></div>
            </div>
          </div>
          <div class="product-dropdown_container">
            <div class="product-dropdown_content">
             <?php the_field('product_advantages'); ?>
            </div>
          </div>
        </div>
        <div class="product-dropdown">
          <div class="product-dropdown_title">
            <div><?php _e('UTILISATION', 'guard-industrie') ?></div>
            <div class="label-cross">
              <div class="line"></div>
              <div class="line second"></div>
            </div>
          </div>
          <div class="product-dropdown_container">
            <div class="product-dropdown_content">
              <?php the_field('product_uses'); ?>
            </div>
          </div>
        </div>
       <?php if(get_field('product_is_conso') ): ?>
         <div class="btn-conso-container">
              <a href="<?php if($u_slug=="particuliers"){ the_field('conso_particuliers', 'option'); } if($u_slug=="pro-du-batiment"){ the_field('conso_pro', 'option'); }?>" class="link-arrow-blue">
                <div class="btn-arrow-picto w-embed">
                  <!--?xml version="1.0" encoding="UTF-8"?-->

                  <svg viewBox="0 0 50 37" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g>
                          <g id="icon/calculate" transform="translate(0.000000, -7.000000)">
                              <path d="M43.5732648,39.1336761 L43.5732648,43.9537275 L6.61953728,43.9537275 L6.61953728,39.1336761 L43.5732648,39.1336761 Z M47.5899743,7 C48.9209947,7 50,8.07900526 50,9.41002571 L50,9.41002571 L50,24.6735219 L45.1799486,24.6735219 L45.1799486,15.2262211 L30.0128535,30.3933162 C29.0719231,31.3330764 27.5476142,31.3330764 26.6066838,30.3933162 L26.6066838,30.3933162 L15.4562982,19.2429306 L3.40616967,31.2930591 L-1.63424829e-13,27.8868895 L13.7532134,14.1336761 C14.6941438,13.1939159 16.2184526,13.1939159 17.159383,14.1336761 L17.159383,14.1336761 L28.3097686,25.2840617 L41.7737789,11.8200514 L32.3264781,11.8200514 L32.3264781,7 Z" id="Path-conso"></path>
                          </g>
                      </g>
                  </svg>
                </div>
                <div class="btn-text">calculer ma consommation</div>
              </a>
            </div>
       <?php endif; ?>
        <?php if(get_field('product_is_nuancier') ): ?>
          <div class="btn-nuancier-container">
          <a href="<?php if($u_slug=="pro-du-batiment"){ the_field('nuancier_pro', 'option'); } if($u_slug=="prescripteurs"){the_field('nuancier_prescripteurs', 'option'); } if($u_slug=="industriels"){ the_field('nuancier_industriels', 'option'); } ?>" class="link-arrow-blue">
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
            <div class="btn-text">voir le nuancier</div>
          </a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="section-video">
       <?php if(get_field('product_video')) : ?>
    <div class="main-wrapper">
      <div class="video-container">
        <div class="video w-video w-embed">
           <?php the_field('product_video'); ?>
        </div>
        <div class="video-layer"></div>
      </div>
    </div>
      <?php endif; ?>
</div>
  <div class="section-tabs">
    <div class="main-wrapper">
      <div data-duration-in="300" data-duration-out="100" class="w-tabs">
      <div class="tabs-menu w-tab-menu">
        <a data-w-tab="Tab 1" class="tab-link w-inline-block w-tab-link w--current">
          <div class="text-tab"><?php _e('LA mise en oeuvre', 'guard-industrie') ?></div>
        </a>
        <a data-w-tab="Tab 2" class="tab-link w-inline-block w-tab-link">
          <div class="text-tab"><?php _e('outils d\'application', 'guard-industrie') ?></div>
        </a>
        <?php if(get_u_slug() != "particuliers") : ?>
        <a data-w-tab="Tab 3" class="tab-link w-inline-block w-tab-link">
          <div class="text-tab"><?php _e('Conditionnement', 'guard-industrie') ?></div>
        </a>
        <?php endif; ?>
        <a data-w-tab="Tab 4" class="tab-link w-inline-block w-tab-link">
          <div class="text-tab"><?php _e('Documents techniques', 'guard-industrie') ?></div>
        </a>
      </div>
      <div class="tabs-content w-tab-content">
        <div data-w-tab="Tab 1" class="tab-content w-tab-pane w--tab-active">
          <div class="main-wrapper">
            <div class="tabs-content-wrapper tab-1">
              
                <?php if( have_rows('product_informations') ):  while ( have_rows('product_informations') ) : the_row(); ?>
                    <?php if( have_rows('product_implementations') ): while ( have_rows('product_implementations') ) : the_row(); ?>
                           <?php if( have_rows('product_implementation_preparations') ): ?>
                           
                               <div class="preparation-container">
                            <h3 class="tab-title"><?php _e('Préparation du support :', 'guard-industrie') ?></h3>
                            <ul role="list" class="preparation-list w-list-unstyled">
                              <?php
                                if( have_rows('product_informations') ): while ( have_rows('product_informations') ) : the_row(); 
                                  
                                   if( have_rows('product_implementations') ): while ( have_rows('product_implementations') ) : the_row(); 
                                
                                    if( have_rows('product_implementation_preparations') ): $i = 1;  while ( have_rows('product_implementation_preparations') ) : the_row(); ?>      
                                
                                <li class="preparation-item">
                                    <div class="preparation-step">
                                      <div class="preparation-step-indicator"><?php echo $i++ ?></div>
                                    </div>
                                    <div class="preparation-text">
                                      <?php echo the_sub_field('product_implementation_preparation'); ?>
                                    </div>
                                  </li>
                                
                                  <?php   endwhile; endif;
                                  
                                  endwhile; endif;
                                
                                endwhile; endif;
                                
                                ?>
                            </ul>
                          </div>
                           <?php endif ;?>
                      <?php endwhile; endif; ?>
                    <?php endwhile; endif; ?>
              
              <div class="application-container <?php if( have_rows('product_informations') ):  while ( have_rows('product_informations') ) : the_row(); if( have_rows('product_implementations') ): while ( have_rows('product_implementations') ) : the_row(); if( !have_rows('product_implementation_preparations') ): ?> alone <?php endif; endwhile; endif; endwhile; endif; ?>">
                <h3 class="tab-title"><?php _e('Application :', 'guard-industrie') ?></h3>
                <div class="application-list">
                  <?php
                  $product_info = get_field('product_informations'); // 'our_services' is your parent group
                  $product_implementations = $product_info['product_implementations'];
                ?>
                <?php echo $product_implementations['product_implementation_applications']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div data-w-tab="Tab 2" class="tab-content w-tab-pane">
          <div class="main-wrapper">
            <div class="tabs-content-wrapper">
              <ul role="list" class="tools-list w-list-unstyled">
                 <?php
                    if( have_rows('product_informations') ) : while ( have_rows('product_informations') ) : the_row(); 
                    
                        if( have_rows('product_tools') ) : while ( have_rows('product_tools') ) : the_row(); ?>      
                    
                          <li class="tools-item">
                      <a href="#" class="tools-picto-container w-inline-block">
                        <div class="html-embed w-embed">
                          <!--?xml version="1.0" encoding="UTF-8"?-->
                          <svg viewBox="0 0 62 71" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:white;">
                            <g id="D---Fiche-produit">
                              <g id="D.1.0---Fiche-produit---Particulier-Deploy" transform="translate(-441.000000, -2401.000000)">
                                <g id="//-Onglets" transform="translate(-0.500000, 2256.000000)">
                                  <g id="Group-5" transform="translate(395.500000, 99.000000)">
                                    <g id="Group-10" transform="translate(0.000000, 8.000000)">
                                      <g id="icon/tools" transform="translate(41.883117, 38.961039)">
                                        <path d="M44.4518308,66.4301617 C44.2970113,64.9252236 43.6443719,63.1048224 42.4984363,60.988975 C41.677011,59.4722755 40.7993236,58.1685801 40.274023,57.4266566 L53.7079778,46.08661 C56.1677868,48.9655852 58.6386221,50.9267262 61.0608289,51.9200476 C61.4800516,52.0920001 61.8661391,52.2208656 62.2160944,52.3171047 C58.5445882,55.2248612 49.4364754,62.4425705 44.4518308,66.4301617 L44.4518308,66.4301617 Z M30.9677208,44.2788748 C31.2881033,43.5900468 31.8075232,43.1635864 31.8087107,43.1626252 C31.8391317,43.1385371 31.8678565,43.1124134 31.8947152,43.0844238 L33.0581797,41.8711434 C33.6003872,41.3057526 34.094362,40.1375384 33.3688365,37.7826763 C32.898667,36.2564774 32.0140246,34.6362445 31.0024393,33.4484093 C30.3008888,32.6246656 28.8366628,31.1206887 27.141169,29.379337 C26.6253113,28.8495129 26.0878536,28.2974666 25.5455331,27.7375041 C25.4650134,27.563516 25.3275531,27.4219845 25.1571838,27.336093 C22.6529871,24.74363 20.1287171,22.0547017 19.2121835,20.6590645 C17.946373,18.7315676 18.5049219,17.4439309 18.7220537,17.0737325 C18.836896,17.0249909 19.0678247,16.9568545 19.4233215,16.9843918 C19.9692609,17.0268003 20.8934846,17.3052832 22.195936,18.3911683 C23.9514804,19.8548287 26.1982855,23.353817 28.37113,26.7376235 C29.8565037,29.0507556 31.2594917,31.2357007 32.5411346,32.8484696 C34.8564719,35.7619937 37.2656734,36.2740062 38.6735243,36.2738932 C39.3903984,36.2738366 39.8479019,36.141013 39.9006016,36.1248978 C39.9767673,36.1015448 40.0493142,36.067618 40.1159805,36.0240785 L41.7957549,34.9272237 C42.1916812,34.6686447 44.0910188,33.9122457 45.4751208,35.244157 C46.5411022,36.269935 47.7366275,37.9809222 49.1209557,39.9620235 C50.1605307,41.449772 51.3230339,43.1130354 52.6336278,44.7735281 L39.1891557,56.1226219 C37.4970545,54.3234816 32.3994901,48.8464454 31.2065092,46.9071306 C30.6466033,45.99693 30.5684585,45.1372239 30.9677208,44.2788748 L30.9677208,44.2788748 Z M22.6773579,29.9226754 C22.3585587,29.9226754 22.0667313,30.1014133 21.9218637,30.3853244 L18.1738525,37.7307683 C17.9490306,37.605974 17.7090548,37.4992741 17.4542076,37.4142874 C17.3875414,37.3920653 17.3219495,37.3719354 17.25681,37.3528232 L21.3794866,29.0191471 L24.3596203,28.9512934 C24.6770625,29.2790267 24.992469,29.60365 25.3028431,29.9226754 L22.6773579,29.9226754 Z M18.2013332,41.8662806 C17.9264693,42.3930513 17.0764323,44.1647675 16.0003294,46.4077841 C14.1035363,50.3611658 11.5058146,55.7756069 10.7031621,57.1801781 C9.31979511,59.6011975 8.75299068,60.3953118 7.01684113,59.5484978 C6.45817915,59.2760087 6.11008976,58.9125392 5.9527823,58.4374503 C5.60305312,57.3814774 6.20259694,55.8587277 6.76713958,54.7672446 C6.92733082,54.4576057 7.19970681,53.9343972 7.54711766,53.2670563 C9.24391208,50.007535 12.7747915,43.2250505 13.7256478,41.1618462 C14.5197055,39.4391543 15.2143576,38.9086516 15.9016023,38.8514284 C15.929705,38.8542556 15.9578643,38.8561781 15.985854,38.8561781 C16.0248133,38.8561781 16.063603,38.853464 16.1018837,38.8481488 C16.3717152,38.859175 16.6418294,38.9316088 16.9177677,39.0236071 C17.5619819,39.2383074 18.0435169,39.6701396 18.2736539,40.239432 C18.4890328,40.7724227 18.4626264,41.3654073 18.2013332,41.8662806 L18.2013332,41.8662806 Z M36.9626502,28.6713404 C37.2738159,28.6642723 37.5560872,28.4873438 37.6981276,28.2103312 L42.4320528,18.9756712 C42.5409014,18.7632892 42.5552638,18.5148316 42.4715776,18.2913103 C42.3878914,18.0678455 42.2139032,17.8898992 41.9923044,17.801237 L41.9176654,17.7713814 C41.921058,17.7644264 41.92479,17.7578107 41.9281827,17.7507991 C41.937456,17.7318001 41.9460508,17.7129707 41.955098,17.6940282 L43.581268,18.5244442 L38.0530589,29.9226754 L32.494881,29.9226754 C32.2434266,29.5597147 31.987392,29.1813739 31.7273994,28.7906498 L36.9626502,28.6713404 Z M38.7936253,18.538128 C37.6124058,18.9299265 35.9250543,18.5662308 33.7781638,17.4571058 C33.3722292,17.2473814 32.6865112,16.8908668 31.8118206,16.4360775 C27.5396963,14.2148872 18.6501853,9.59292054 15.9506831,8.35034999 C12.7274636,6.86678577 12.4301514,5.57496474 13.0058333,3.84503511 C13.3116838,2.92595699 13.9310748,2.23729865 14.7498991,1.90583342 C15.0953309,1.76605483 15.4582916,1.6966179 15.819047,1.6966179 C16.262697,1.6966179 16.7030108,1.80162147 17.1030083,2.01010191 C17.7898572,2.36797354 20.1111882,3.48026503 23.0500443,4.88839857 C28.2367798,7.37370932 35.3402687,10.7773631 37.1844187,11.8298868 L37.1900731,11.8331099 C38.5815825,12.6273372 39.7833278,13.3132249 40.4091649,14.1264512 C40.8324023,14.6764053 41.1626801,15.448863 40.4031146,17.0078579 C40.0136345,17.8075135 39.4870899,18.308104 38.7936253,18.538128 L38.7936253,18.538128 Z M65.1211933,51.3616683 C64.9582879,51.0080941 64.5881461,50.8086608 64.2066953,50.8806423 C64.1208038,50.8896894 63.1430323,50.973206 61.5391974,50.2809853 C58.6852715,49.0492148 56.1197238,46.3771934 54.4700877,44.3526657 C52.9832439,42.527854 51.6700489,40.6485331 50.5114473,38.9904153 C49.0762288,36.9364278 47.8367117,35.1625064 46.6512513,34.0217729 C45.7582403,33.1624625 44.6087989,32.7344754 43.3285131,32.7838955 C42.2681296,32.824947 41.3623395,33.1842323 40.8683082,33.5068765 L39.3103876,34.5241163 C38.7806765,34.6307031 36.3468215,34.9108258 33.8692008,31.7930621 C33.8237954,31.735952 33.7781073,31.6777674 33.732306,31.6190175 L38.5843532,31.6190175 C38.9093158,31.6190175 39.2057233,31.4333811 39.347481,31.1409883 L45.4701449,18.5170368 C45.6716138,18.1017158 45.5038456,17.6014645 45.0927088,17.3915704 L42.4945913,16.0648048 C42.6799449,14.957885 42.4337492,13.9757595 41.753516,13.0919088 C40.9199335,12.0087378 39.5166628,11.2078382 38.0309499,10.3598933 L38.0252954,10.3566137 C36.1282196,9.27389515 28.9929525,5.85497427 23.7830337,3.3586373 C20.974287,2.01275951 18.5485179,0.850482477 17.8869445,0.505729226 C16.7203135,-0.102239768 15.3449194,-0.165004424 14.1134881,0.333437418 C12.82653,0.854327519 11.8615375,1.91120517 11.3962874,3.30938684 C10.8965451,4.81115846 10.9816449,6.0732935 11.6564498,7.16794303 C12.2866408,8.19027184 13.4257911,9.05557592 15.241386,9.89130711 C17.9038514,11.1168012 26.768935,15.7260453 31.0292415,17.9411287 C31.9057414,18.3968227 32.59276,18.7540724 32.9995993,18.9642492 C34.843297,19.9166887 36.4189726,20.3888372 37.7689781,20.3888372 C38.3259438,20.3888372 38.8446852,20.3084306 39.3276903,20.1482394 C39.6015365,20.057372 39.8598894,19.9408333 40.1032014,19.8000934 L36.4189726,26.9869858 L30.633598,27.1187351 C30.3585644,26.6931228 30.0800816,26.2594813 29.7985453,25.8210334 C27.5564335,22.329396 25.2379863,18.718845 23.282217,17.0882645 C21.854632,15.8979978 20.5109595,15.290255 19.2884623,15.2817733 C18.2648895,15.2739701 17.6955971,15.6970944 17.5917244,15.7818549 C17.5476195,15.8178174 17.5072466,15.8581338 17.4712276,15.9021821 C17.3939309,15.9966684 15.6037812,18.2547824 17.7942677,21.5901867 C18.632713,22.8670233 20.6201474,25.0455223 22.7621185,27.2908572 L20.8275535,27.3349621 C20.5120338,27.3421433 20.226596,27.5239346 20.0866478,27.8068279 L15.4346559,37.2104436 C13.7857548,37.5021013 12.844907,39.0202709 12.1850865,40.451814 C11.2512502,42.477925 7.73314984,49.2359821 6.04246225,52.483742 C5.69409014,53.1528359 5.42103561,53.6774014 5.26044856,53.9878886 C4.20690706,56.0247996 3.90659797,57.6547581 4.34244479,58.9707803 C4.64659892,59.8892364 5.29618484,60.5965545 6.27316477,61.0731135 C6.94825237,61.4024301 7.58392828,61.5670318 8.17679983,61.5670318 C8.85528011,61.5669752 9.47761147,61.3513702 10.0382525,60.9203862 C10.8969409,60.2602264 11.5181979,59.1729277 12.1784707,58.0174926 C13.0088867,56.5642929 15.5155714,51.3396724 17.5296949,47.1415651 C18.5566603,45.0010641 19.4435645,43.1525037 19.7052535,42.6509519 C20.1967969,41.70886 20.2482526,40.5982083 19.8463892,39.6038692 C19.7467574,39.3573907 19.6221328,39.1261792 19.4760777,38.91097 L23.1967779,31.6190175 L26.9533274,31.6190175 C28.1772947,32.8796258 29.1869009,33.932828 29.7110141,34.5483175 C30.5806156,35.5694023 31.3419339,36.9652091 31.7476989,38.282136 C32.1489969,39.5845874 32.0736793,40.4469512 31.8338731,40.6970485 L30.7043355,41.8749319 C30.5125923,42.0369891 29.8978379,42.6001181 29.4654968,43.4880401 C28.9910865,44.4623624 28.6573029,46.0007185 29.7616216,47.7959573 C31.2459209,50.2088343 37.8793535,57.2103165 38.4756177,57.837963 C38.6691703,58.0954112 39.9053513,59.7630851 41.0067862,61.7968861 C42.4921033,64.5393058 43.0790942,66.7581777 42.6596454,68.0448532 C42.5433329,68.4015939 42.6753083,68.7924311 42.9841556,69.0056613 C43.1295887,69.1060848 43.2979789,69.1558442 43.4659168,69.1558442 C43.6546631,69.1558442 43.8429005,69.093023 43.9976069,68.9686245 C49.4114826,64.6145103 64.7105654,52.5056249 64.8644802,52.3838275 C65.1714616,52.1409113 65.2849469,51.7172216 65.1211933,51.3616683 L65.1211933,51.3616683 Z" id="Fill-1"></path>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </g>
                            </g>
                          </svg>
                        </div>
                      </a>
                      <div class="tools-text">
                       <?php if( the_sub_field('product_tool_heading') ) : ?>
                            <h3 class="tools-title"><?php  echo the_sub_field('product_tool_heading');  ?></h3>
                        <?php endif;?>
                        <p class="tools-description"><?php  echo the_sub_field('product_tool_text'); ?></p>
                      </div>
                    </li>
                    
                      <?php   
                        endwhile; endif;
                        
                      endwhile; endif;
                    ?>
              </ul>
            </div>
          </div>
        </div>
        <?php if(get_u_slug() != "particuliers") : ?>
        <div data-w-tab="Tab 3" class="tab-content w-tab-pane">
          <div class="main-wrapper">
            <div class="tabs-content-wrapper">
              <ul role="list" class="conditionnement-list w-list-unstyled">
                <?php
                $featured_posts = get_field('product_conditionnement');
                if( $featured_posts ): ?>
                    <?php foreach( $featured_posts as $post ): 
                        setup_postdata($post); ?>
                        <li class="conditionnement-item">
                            <div class="conditionnement-img-container w-inline-block">
                              <img class="conditionnement-img" src="<?php the_post_thumbnail_url(); ?>"/>
                            </div>
                            <div class="conditionnement-text">
                              <h3 class="conditionnement-title"><?php the_title() ;?></h3>
                            </div>
                       </li>
                    <?php endforeach; ?>
                    <?php 
                    // Reset the global post object so that the rest of the page works correctly.
                    wp_reset_postdata(); ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div data-w-tab="Tab 4" class="tab-content w-tab-pane">
          <div class="main-wrapper">
            <div class="tabs-content-wrapper">
              <ul role="list" class="documents-list w-list-unstyled">
               <?php
                    if( have_rows('product_informations') ) : while ( have_rows('product_informations') ) : the_row(); 
                    
                        if( have_rows('product_documents') ) : while ( have_rows('product_documents') ) : the_row(); ?>      
                    
                         <li class="documents-item">
                            <a href="<?php echo get_sub_field('product_document_file')['url']?>" download target="_blank" class="document-img-container w-inline-block">
                              <div class="html-embed-2 w-embed">
                                <!--?xml version="1.0" encoding="UTF-8"?-->
                                <svg viewBox="0 0 38 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <g id="D---Fiche-produit">
                                    <g id="D.1.1---Fiche-produit---Pros" transform="translate(-313.000000, -2340.000000)">
                                      <g id="//-Onglets" transform="translate(0.000000, 2115.000000)">
                                        <g id="preparation" transform="translate(259.500000, 109.000000)">
                                          <g id="01" transform="translate(0.000000, 95.000000)">
                                            <g id="icon/download" transform="translate(52.000000, 21.000000)">
                                              <path d="M10.7432609,26.263911 L2.98491433,26.263911 L2.98491433,31.2877583 C2.98491433,33.3227345 3.81162339,35.1669316 5.21066949,36.5023847 C6.54612259,37.8378378 8.39031973,38.7281399 10.4252959,38.7281399 L30.4570924,38.7281399 C32.4920685,38.7281399 34.3362657,37.8378378 35.6717188,36.5023847 C37.0707649,35.1669316 37.8974739,33.3227345 37.8974739,31.2877583 L37.8974739,26.263911 L30.1391274,26.263911 L30.1391274,27.9173291 C30.1391274,28.6804452 29.8211623,29.3799682 29.2488253,29.8887122 C28.7400813,30.4610493 28.0405582,30.7790143 27.2774421,30.7790143 L13.6049461,30.7790143 C12.8418301,30.7790143 12.142307,30.4610493 11.633563,29.9523052 C11.0612259,29.3799682 10.7432609,28.6804452 10.7432609,27.9173291 L10.7432609,26.263911 Z M17.9928635,3.9427663 L17.9928635,5.21462639 L6.48252959,5.21462639 L3.11210034,24.9920509 L12.015121,24.9920509 L12.015121,27.9173291 C12.015121,28.3624801 12.2059,28.7440382 12.523865,28.9984102 C12.7782371,29.3163752 13.1597951,29.5071542 13.6049461,29.5071542 L27.2774421,29.5071542 C27.7225932,29.5071542 28.1041512,29.3163752 28.3585232,28.9984102 C28.6764883,28.7440382 28.8672673,28.3624801 28.8672673,27.9173291 L28.8672673,26.263911 L28.8036743,26.263911 L28.8036743,24.9920509 L37.7702879,24.9920509 L34.8450097,5.21462639 L23.0167108,5.21462639 L23.0167108,3.9427663 L35.9260908,3.9427663 C36.7527999,9.47535771 38.406218,21.1128776 39.169334,25.5643879 C39.232927,28.4260731 39.169334,29.5707472 39.169334,31.2877583 C39.169334,33.6406995 38.151846,35.8664547 36.6256138,37.3926868 C35.0357887,38.9825119 32.8736266,40 30.4570924,40 L10.4252959,40 C8.0087617,40 5.84659954,38.9825119 4.25677442,37.3926868 C2.73054231,35.8664547 1.71305423,33.6406995 1.71305423,31.2877583 C1.71305423,29.6343402 1.45868221,27.027027 1.71305423,25.5643879 C2.92132132,18.8871224 4.51114644,9.09379968 5.40144851,3.9427663 L17.9928635,3.9427663 Z M21.1089207,0 L20.8545487,19.3958665 L22.9531178,17.4244833 L24.797315,17.4244833 L23.3346759,18.7599364 L20.1550256,21.7488076 L15.5763293,17.4244833 L17.4205264,17.4244833 L19.5826886,19.4594595 L19.8370606,0 L21.1089207,0 Z" id="Shape"></path>
                                            </g>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                  </div>
                            </a>
                            <div class="document-text">
                              <h3 class="documents-title"><?php echo the_sub_field('product_document_title') ?></h3>
                              <!--<div class="documents-description"> Taille du fichier : 663 Ko</div>-->
                            </div>
                          </li>
                          
                      <?php   
                        endwhile; endif;
                      endwhile; endif;
                    ?>
                      <?php
                    if( have_rows('product_informations') ) : while ( have_rows('product_informations') ) : the_row(); 
                    
                        if( have_rows('product_documents_specific') ) : while ( have_rows('product_documents_specific') ) : the_row(); ?>      
                    
                         <li class="documents-item">
                            <a href="<?php echo get_sub_field('product_document_specific_file')['url']?>" download target="_blank" class="document-img-container w-inline-block">
                              <div class="html-embed-2 w-embed">
                                <!--?xml version="1.0" encoding="UTF-8"?-->
                                <svg viewBox="0 0 38 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <g id="D---Fiche-produit">
                                    <g id="D.1.1---Fiche-produit---Pros" transform="translate(-313.000000, -2340.000000)">
                                      <g id="//-Onglets" transform="translate(0.000000, 2115.000000)">
                                        <g id="preparation" transform="translate(259.500000, 109.000000)">
                                          <g id="01" transform="translate(0.000000, 95.000000)">
                                            <g id="icon/download" transform="translate(52.000000, 21.000000)">
                                              <path d="M10.7432609,26.263911 L2.98491433,26.263911 L2.98491433,31.2877583 C2.98491433,33.3227345 3.81162339,35.1669316 5.21066949,36.5023847 C6.54612259,37.8378378 8.39031973,38.7281399 10.4252959,38.7281399 L30.4570924,38.7281399 C32.4920685,38.7281399 34.3362657,37.8378378 35.6717188,36.5023847 C37.0707649,35.1669316 37.8974739,33.3227345 37.8974739,31.2877583 L37.8974739,26.263911 L30.1391274,26.263911 L30.1391274,27.9173291 C30.1391274,28.6804452 29.8211623,29.3799682 29.2488253,29.8887122 C28.7400813,30.4610493 28.0405582,30.7790143 27.2774421,30.7790143 L13.6049461,30.7790143 C12.8418301,30.7790143 12.142307,30.4610493 11.633563,29.9523052 C11.0612259,29.3799682 10.7432609,28.6804452 10.7432609,27.9173291 L10.7432609,26.263911 Z M17.9928635,3.9427663 L17.9928635,5.21462639 L6.48252959,5.21462639 L3.11210034,24.9920509 L12.015121,24.9920509 L12.015121,27.9173291 C12.015121,28.3624801 12.2059,28.7440382 12.523865,28.9984102 C12.7782371,29.3163752 13.1597951,29.5071542 13.6049461,29.5071542 L27.2774421,29.5071542 C27.7225932,29.5071542 28.1041512,29.3163752 28.3585232,28.9984102 C28.6764883,28.7440382 28.8672673,28.3624801 28.8672673,27.9173291 L28.8672673,26.263911 L28.8036743,26.263911 L28.8036743,24.9920509 L37.7702879,24.9920509 L34.8450097,5.21462639 L23.0167108,5.21462639 L23.0167108,3.9427663 L35.9260908,3.9427663 C36.7527999,9.47535771 38.406218,21.1128776 39.169334,25.5643879 C39.232927,28.4260731 39.169334,29.5707472 39.169334,31.2877583 C39.169334,33.6406995 38.151846,35.8664547 36.6256138,37.3926868 C35.0357887,38.9825119 32.8736266,40 30.4570924,40 L10.4252959,40 C8.0087617,40 5.84659954,38.9825119 4.25677442,37.3926868 C2.73054231,35.8664547 1.71305423,33.6406995 1.71305423,31.2877583 C1.71305423,29.6343402 1.45868221,27.027027 1.71305423,25.5643879 C2.92132132,18.8871224 4.51114644,9.09379968 5.40144851,3.9427663 L17.9928635,3.9427663 Z M21.1089207,0 L20.8545487,19.3958665 L22.9531178,17.4244833 L24.797315,17.4244833 L23.3346759,18.7599364 L20.1550256,21.7488076 L15.5763293,17.4244833 L17.4205264,17.4244833 L19.5826886,19.4594595 L19.8370606,0 L21.1089207,0 Z" id="Shape"></path>
                                            </g>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                  </div>
                            </a>
                            <div class="document-text">
                              <h3 class="documents-title"><?php echo the_sub_field('product_document_specific_title') ?></h3>
                            </div>
                          </li>
                          
                      <?php   
                        endwhile; endif;
                      endwhile; endif;
                    ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
  </div>
  
  <?php if(get_u_slug()=="particuliers" || get_u_slug()=="pro-du-batiment"): ?> 
  <div class="section-distributor">
    <div class="main-wrapper">
      <div class="distributor-block">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/distributor.svg?v=1615475113908" loading="lazy" alt="" class="distributor-img">
        <div class="distributor-text">
          <h3 class="distributor-title">
             <?php the_field('product_section_title', 'options') ?>
          </h3>
          <div class="distributor-description">
            <?php if($u_slug=="particuliers"){
              echo 'Les produits Guard Industrie sont en vente dans des enseignes de bricolage. Retrouvez ci-dessous la liste des magasins les plus proches de chez vous.';
            } else {
              echo 'Guard Industrie a noué des partenariats avec les plus grandes enseignes professionnelles. Nos produits sont disponibles partout en France pour vous accompagner au mieux sur vos chantiers.';
            } ?>
          </div>
          <div class="distributor-link-container">
            <a href="<?php if(get_u_slug()=="particuliers"){ the_field('storelocator_link', 'option'); } else { the_field('storelocator_link_pro', 'option');}?>" class="link-arrow-white w-inline-block">
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
              <div class="btn-text"><?php _e('TRouver un distributeur', 'guard-industrie') ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php else : ?>
  <div class="section-distributor">
    <div class="main-wrapper">
      <div class="distributor-block">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-commercial.svg" loading="lazy" alt="" class="distributor-img">
        <div class="distributor-text">
          <h2 class="distributor-title">
             Un projet ? Contactez un commercial
          </h2>
          <div class="distributor-description">
            Nos équipes commerciales vous accompagnent tout au long de votre projet, du choix des produits jusqu’à leur mise en œuvre.
          </div>
          <div class="distributor-link-container">
            <a href="<?php echo home_url().'/contacter-un-commercial-'.$u_slug ?>" class="link-arrow-white w-inline-block">
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
              <div class="btn-text">contacter un commercial</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php
    $featured_posts = get_field('product_advices');
    if( $featured_posts ): ?>
            
  <div class="section-advice">
    <div class="section-advice-wrapper">
      <div class="main-wrapper">
        <h2 class="main-title-black">Nos conseils</h2>
        <div class="advice-btn-container">
          <a href="<?php if($u_slug=="particuliers"){ the_field('advice_link', 'option'); }else { the_field('advice_link_pro', 'option'); } ?>" class="btn-arrow-border-white w-inline-block">
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
            <div class="btn-text">tous les conseils</div>
          </a>
        </div>
        <ul role="list" class="advice-list w-list-unstyled">
          <?php foreach( $featured_posts as $post ): 
              setup_postdata($post); 
              $terms = get_the_terms( $post->ID, 'gamme');
        	    $gamme_name;
        	    if( $terms && ! is_wp_error( $terms ) ){
                  foreach( $terms as $term ){
                      $gamme_name = $term->name;
                  }
              } 
              ?>
              <li class="advice-item">
                <a class="advice-item-container" href="<?php the_permalink();?>">
                   <div class="advice-img-container">
                      <img src="<?php the_post_thumbnail_url('full') ?>" loading="lazy" alt="" class="advice-poster">
                  </div>
                  <div class="advice-text">
                    <div class="advice-tag"><?php echo $gamme_name; ?></div>
                    <div class="subtitle-black"><?php the_title(); ?></div>
                  </div>
                </a>
              </li>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
          
        </ul>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
   <?php $featured_reference = get_field('product_references');
        if( $featured_reference ): ?>
    <div class="section-reference">
    <div class="section-reference-wrapper">
      <div class="main-wrapper">
        <h2 class="main-title-black"><?php _e('Les références', 'guard-industrie') ?><br><?php _e(' associées', 'guard-industrie') ?></h2>
        <div class="reference-list">
          <div class="reference-col-highlight <?php if( !isset($featured_reference[2]) ): ?>col-half<?php endif; ?>">
            <div class="reference-item">
              <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>" class="reference-img">
               <img src="<?php echo get_field('reference_gallery', $featured_reference[0])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
              </a>
              <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>"  class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[0]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[0]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <div class="link-arrow-white w-inline-block">
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
              </a>
            </div>
          </div>
          <?php if(isset($featured_reference[1])): ?>
          <div class="reference-col <?php if( !isset($featured_reference[2]) ): ?>col-half<?php endif; ?>">
            <div class="reference-item">
               <a href="<?php echo get_the_permalink($featured_reference[1]->ID); ?>" class="reference-img">
                 <img src="<?php echo get_field('reference_gallery', $featured_reference[1])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
               </a>
              <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>" class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[1]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[1]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <div class="link-arrow-white w-inline-block">
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
              </a>
            </div>
            <?php if( isset($featured_reference[2])): ?>
            <div class="reference-item">
               <a href="<?php echo get_the_permalink($featured_reference[2]->ID); ?>" class="reference-img">
                <img src="<?php echo get_field('reference_gallery', $featured_reference[2])[0]['url'] ?>" loading="lazy" alt="" class="reference-img">
               </a>
             <a href="<?php echo get_the_permalink($featured_reference[0]->ID); ?>" class="reference-text">
                <div class="reference-city"> <?php the_field('reference_city',$featured_reference[2]->ID); ?></div>
                <div class="subtitle-white"><?php echo get_the_title($featured_reference[2]->ID); ?></div>
                <div class="reference-item-btn-container">
                  <div class="link-arrow-white w-inline-block">
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
              </a>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="reference-btn-container">
          <a href="<?php if(get_u_slug()=="particuliers"){ the_field('reference_link', 'option'); } else { the_field('reference_link_pro', 'option');}?>" class="btn-arrow-border-white-smoke w-inline-block">
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
  
  <?php
      $product_related = get_field('product_related');
      if( $product_related ): ?>
    <div class="section-related-products">
    <div class="title-container">
      <div class="slider-product-previous">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-40">
      </div>
      <h2 class="main-title-black"><?php _e('Voir aussi', 'guard-industrie') ?></h2>
      <div class="slider-product-next">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/chevron.svg?v=1615475113908" loading="lazy" alt="" class="image-41">
      </div>
    </div>
    <div class="product-container">
      <div class="swiper-container product-slider">
        <div class="swiper-wrapper">
         
                <?php foreach( $product_related as $post ): 
                  if ( 'publish' == get_post_status($post) ):
            
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); 
                    global $product; 
                     $terms = get_the_terms( $post, 'gamme' );
                	   $color;
                	   if( $terms && ! is_wp_error( $terms ) ){
                          foreach( $terms as $term ){
                              $color = get_field( 'gamme_color', 'gamme_' . $term->term_id );
                          }
                      }?>
                    
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
                        <div class="product-function"><?php echo $term->name; ?></div>
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
                            <div class="btn-text">
                              <?php
                               if($u_slug=="particuliers"){
                                echo 'Acheter';
                               } else {
                                echo 'découvrir';
                               }    
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php 
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata(); ?>
            
        </div>
      </div>
    </div>
    <div class="related-products-btn-container">
      <a href="<?php if($u_slug=="particuliers"){ the_field('catalogue_particulier', 'option'); }else { the_field('catalogue_pro', 'option'); } ?>" class="btn-arrow-border-white w-inline-block">
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
  <?php endif; ?>
