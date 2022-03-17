  <?php

    if(!is_404()){
    $u_slug="none";
    $univers=get_the_terms($post->ID,'univers');
    
    if ($univers[0]){
    $u_slug=$univers[0]->slug;
    }
  
    if(is_singular('reference')){
              $u_slug="reference";
    }
  }else{
    $u_slug="particuliers";
  }
  ?>
  
      <?php if(get_field('visible_push','options')): ?>
    <div class="nav-push off">
      <a class="nav-push-content" href="<?php the_field('link_push','options'); ?>">
      <?php the_field('text_push','options'); ?>
      </a>
      <img src="/wp-content/assets/img/close-icon.svg" class="close-push-nav"></img>
    </div>
    <?php endif; ?>
  
<div class="desktop-nav">

    <div class="nav-wrapper">
    <div class="nav-left">
    <div class="nav-item <?php if($u_slug=="particuliers"){ echo "current"; }?>">
        <a class="nav-text" href="<?php the_field('homepage_particulier','options') ?>"><?php _e('Particuliers', 'guard-industrie') ?></a>
      
       <?php if($u_slug=="particuliers"): ?>
        <div class="sub-nav">
          <?php
             if ( has_nav_menu( 'menu-particulier' ) ) : 
             wp_nav_menu ( array (
             'theme_location' => 'menu-particulier' ,
             'menu_class' => 'sub-nav-left', 
             ) ); 
             endif;?>


            <?php include( locate_template( 'template-parts/sub-nav-right.php', false, false ) ); ?>
        </div>

      <?php endif; ?>
         </div>
      
      <?php if(get_field('nav_pro','options')): ?>
      <div class="nav-item <?php if($u_slug=="pro-du-batiment"){ echo "current"; }?>">
        <a class="nav-text" href="<?php the_field('homepage_pro','options') ?>"><?php _e('Pros du bâtiment', 'guard-industrie') ?></a>
        
          <?php if($u_slug=="pro-du-batiment"): ?>
            <div class="sub-nav">
                <?php
                   if ( has_nav_menu( 'menu-pro') ) : 
                   wp_nav_menu ( array (
                   'theme_location' => 'menu-pro' ,
                   'menu_class' => 'sub-nav-left', 
                   ) ); 
                   endif;?>
            </div>
          <?php endif; ?>
          
      </div>
      <?php endif; ?>
      
      <?php if(get_field('nav_prescripteurs','options')): ?>
      <div class="nav-item <?php if($u_slug=="prescripteurs"){ echo "current"; }?>">
        <a class="nav-text" href="<?php the_field('homepage_prescripteurs','options') ?>"><?php _e('Prescripteurs', 'guard-industrie') ?></a>
        
          <?php if($u_slug=="prescripteurs"): ?>
            <div class="sub-nav">
                <?php
                   if ( has_nav_menu( 'menu-prescripteurs') ) : 
                   wp_nav_menu ( array (
                   'theme_location' => 'menu-prescripteurs' ,
                   'menu_class' => 'sub-nav-left', 
                   ) ); 
                   endif;?>
            </div>
          <?php endif; ?>
        
      </div>
      <?php endif; ?>

      <?php if(get_field('nav_industriel','options')): ?>      
      <div class="nav-item <?php if($u_slug=="industriels"){ echo "current"; }?>">
        <a class="nav-text" href="<?php the_field('homepage_industriel','options') ?>"><?php _e('Industriels', 'guard-industrie') ?></a>
        
          <?php if($u_slug=="industriels"): ?>
            <div class="sub-nav">
                <?php
                   if ( has_nav_menu( 'menu-industriels') ) : 
                   wp_nav_menu ( array (
                   'theme_location' => 'menu-industriels' ,
                   'menu_class' => 'sub-nav-left', 
                   ) ); 
                   endif;?>
            </div>
          <?php endif; ?>
        
      </div>
      <?php endif; ?>
      
      <?php if($u_slug=="la-marque"): ?>
        <div class="sub-nav">
            <?php
               if ( has_nav_menu( 'menu-marque') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-marque' ,
               'menu_class' => 'sub-nav-left', 
               ) ); 
               endif;?>
        </div>
      <?php endif; ?>

      <?php if($u_slug=="reference"): ?>
        <div class="sub-nav">
            <?php
               if ( has_nav_menu( 'menu-reference') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-reference' ,
               'menu_class' => 'sub-nav-left', 
               ) ); 
               endif;?>
        </div>
      <?php endif; ?>
  
      <?php if($u_slug=="faq"): ?>
        <div class="sub-nav">
            <?php
               if ( has_nav_menu( 'menu-faq') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-faq' ,
               'menu_class' => 'sub-nav-left', 
               ) ); 
               endif;?>
        </div>
      <?php endif; ?>
      
    </div>
    
    <a href="<?php echo get_site_url(); ?>" class="logo w-inline-block"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png?v=1615988947611" loading="lazy" alt="" class="image"></a>
   
    <div class="nav-right">
      
      <?php if(get_field('la_marque','options')): ?> 
      <a href="<?php the_field('lien_page_marque','options'); ?>" class="nav-right-item w-inline-block <?php if($u_slug=="la-marque"){ echo "current"; }?>">
        <div class="icon-nav w-embed">
          <!--?xml version="1.0" encoding="UTF-8"?-->
          <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="white">
            <g id="icon/brand" stroke="none" stroke-width="1">
              <path d="M25.0086097,0 C35.9545552,0 46.8988693,1.53937048 50,4.62137358 L50,4.62137358 L50,18.2904905 C50,25.8791484 47.3683257,33.001863 42.2160877,39.4581938 C38.0324886,44.6799835 29.3310519,50 24.9747146,50 C20.5699816,50 11.8669137,44.6779899 7.72010977,39.4417018 C2.54013942,33.0883099 0,25.9723008 0,18.2904905 L0,18.2904905 L0,4.62137358 C3.0989556,1.54154524 14.0545077,0 25.0086097,0 Z M25.0068878,4 C16.2436061,4 7.47916448,5.23323619 5,7.69709886 L5,19.6323924 C5,25.7778406 7.03211154,31.4706479 11.1760878,36.5533615 C14.4935309,40.742392 21.4559853,45 24.9797717,45 C28.4648415,45 35.4259908,40.7439868 38.7728701,36.566555 C42.8946605,31.4014904 45,25.7033187 45,19.6323924 L45,7.69709886 C42.5190955,5.23149638 33.7636441,4 25.0068878,4 Z" id="Combined-Shape"></path>
            </g>
          </svg>
        </div>
        <div class="nav-text"><?php _e('La marque', 'guard-industrie') ?></div>
      </a>
      <?php endif; ?>
      
      <?php if(get_field('nos_references','options')): ?> 
      <a href="<?php the_field('lien_page_references','options'); ?>" class="nav-right-item w-inline-block <?php if($u_slug=="reference"){ echo "current"; }?>">
        <div class="icon-nav w-embed">
          <!--?xml version="1.0" encoding="UTF-8"?-->
          <svg fill="white" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="icon/reference" stroke="none" stroke-width="1">
              <g id="Group" transform="translate(30.000000, 3.000000)"></g>
              <path d="M34.52791,0.6927 C34.5052761,0.6927 34.4869257,0.7110504 34.4869257,0.7336843 C34.4869257,0.7563221 34.5052761,0.7746725 34.52791,0.7746725 L35.084697,0.7746725 L35.084697,1.3314635 C35.084697,1.3540974 35.1030474,1.3724478 35.1256852,1.3724478 C35.1483191,1.3724478 35.1666695,1.3540974 35.1666695,1.3314635 L35.1666695,0.7336835 C35.1666695,0.7110496 35.1483191,0.6926992 35.1256852,0.6926992 L34.5279092,0.6926992 L34.52791,0.6927 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
              <path d="M30.80543,0.77467 C30.8280639,0.77467 30.8464143,0.7563196 30.8464143,0.7336818 C30.8464143,0.7110479 30.8280639,0.6926975 30.80543,0.6926975 L30.207654,0.6926975 C30.1850201,0.6926975 30.1666697,0.7110479 30.1666697,0.7336818 L30.1666697,1.3314618 C30.1666697,1.3540957 30.1850201,1.3724461 30.207654,1.3724461 C30.2302918,1.3724461 30.2486422,1.3540957 30.2486422,1.3314618 L30.2486422,0.7746708 L30.8054292,0.7746708 L30.80543,0.77467 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
              <path d="M34.52791,4.55867 C34.5052761,4.55867 34.4869257,4.5770204 34.4869257,4.5996582 C34.4869257,4.6222921 34.5052761,4.6406425 34.52791,4.6406425 L35.125686,4.6406425 C35.1483199,4.6406425 35.1666703,4.6222921 35.1666703,4.5996582 L35.1666703,4.0018782 C35.1666703,3.9792443 35.1483199,3.9608939 35.125686,3.9608939 C35.1030482,3.9608939 35.0846978,3.9792443 35.0846978,4.0018782 L35.0846978,4.5586692 L34.5279108,4.5586692 L34.52791,4.55867 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
              <path d="M30.80543,4.64064 C30.8280639,4.64064 30.8464143,4.6222896 30.8464143,4.5996557 C30.8464143,4.5770179 30.8280639,4.5586675 30.80543,4.5586675 L30.248643,4.5586675 L30.248643,4.0018765 C30.248643,3.9792426 30.2302926,3.9608922 30.2076548,3.9608922 C30.1850209,3.9608922 30.1666705,3.9792426 30.1666705,4.0018765 L30.1666705,4.5996565 C30.1666705,4.6222904 30.1850209,4.6406408 30.2076548,4.6406408 L30.8054308,4.6406408 L30.80543,4.64064 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
              <path d="M20.4991322,7 C21.3999494,7 22.1918973,7.62563362 22.4406061,8.53375161 L22.8584095,10.065626 C24.9379717,17.7998312 30.7004933,23.8445467 38.0741233,26.0264618 L39.5366371,26.4646846 C40.4002852,26.7237641 40.9967602,27.5503155 41,28.4924877 C41.0032135,29.4346598 40.4124152,30.2656844 39.5505638,30.531265 L37.8514967,31.0564972 C30.1054032,33.4480067 24.2128428,40.0697912 22.4714872,48.3398343 C22.2716336,49.28533 21.4863613,49.9686127 20.5635183,50 L20.4991322,50 C19.5988177,49.9991708 18.8076232,49.373384 18.5596767,48.4655852 L18.1416714,46.9358278 C16.0608225,39.2022006 10.2983948,33.1580646 2.92515031,30.9754154 L1.46263655,30.5371926 C0.596657851,30.2764538 0,29.445712 0,28.5007269 C0,27.5557418 0.596657851,26.725 1.46263655,26.4642612 L2.92313193,26.0260384 C10.29655,23.8449103 16.0593803,17.801234 18.1398549,10.067743 L18.5576583,8.53375161 C18.8063671,7.62563362 19.598315,7 20.4991322,7 Z M20.4957948,16 C18.1158894,21.5009063 14.0511598,25.9274002 9,28.5189298 C14.0398709,31.1041826 18.0974901,35.5161693 20.4793476,41 C22.8891618,35.5233751 26.9575725,31.1178865 32,28.5248327 C26.9447229,25.9336513 22.8766945,21.5047165 20.4957948,16 Z M40.8597381,20.079681 C40.071255,20.0804283 39.3780942,19.4996484 39.1619191,18.6571254 L38.9979503,18.0224139 C38.2769741,15.1757639 36.274769,12.9510916 33.712784,12.1500068 L33.1399534,11.9660524 C32.3820846,11.7251502 31.8596712,10.9553463 31.8596712,10.0794886 C31.8596712,9.20363097 32.3820846,8.43382711 33.1399534,8.19292488 L33.7110171,8.01073734 C36.2730742,7.20978944 38.2753303,4.98506046 38.9961834,2.13833033 L39.1619191,1.50263716 C39.3786124,0.660487089 40.0714352,0.0799269237 40.8597381,0.0799269237 C41.6480411,0.0799269237 42.3408639,0.660487089 42.5575572,1.50263716 L42.721526,2.13734871 C43.4425022,4.98399871 45.4447073,7.208671 48.0066923,8.00975573 L48.5795229,8.19371017 C49.3354515,8.43441004 49.8572475,9.20121592 49.8596712,10.0749413 C49.862078,10.9486667 49.3445313,11.7190196 48.5899476,11.9648745 L47.9255913,12.1808295 C45.235809,13.0614195 43.1898931,15.4977214 42.5852976,18.540117 C42.4103437,19.4169273 41.7229084,20.0505731 40.9150423,20.079681 L40.8597381,20.079681 Z M40.9671925,15.1912829 C42.0461095,13.2342812 43.4035016,11.5424486 44.9715779,10.2002787 C43.4007127,8.85565299 42.0433287,7.15711177 40.9686543,5.19128293 C39.896533,7.15568606 38.5409771,8.85245623 36.9715779,10.1944848 C38.5392995,11.5358345 39.8941795,13.2302076 40.9671925,15.1912829 Z" id="Shape"></path>
            </g>
          </svg>
        </div>
        <div class="nav-text"><?php _e('Nos références', 'guard-industrie') ?></div>
      </a>
      <?php endif; ?>      
      
      <?php if(get_field('contactez-nous','options')): ?>       
      <a href="<?php the_field('lien_page_contact','options'); ?>" class="nav-right-item  <?php if($u_slug=="contact"){ echo "current"; }?>" >
        <div class="icon-nav w-embed">
          <!--?xml version="1.0" encoding="UTF-8"?-->
          <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="white">
            <g id="icon/question" stroke="none" stroke-width="1">
              <path d="M1.25,50 C0.9235,50 0.604,49.872 0.366,49.634 C0.03,49.298 -0.0865,48.801 0.065,48.351 L3.5875,37.899 C1.239,34.007 -0.000371523443,29.561 -0.000371523443,25 C-0.000371523443,11.215 11.215,0 25,0 C38.785,0 50,11.215 50,25 C50,38.785 38.785,50 25,50 C20.4395,50 15.993,48.761 12.1015,46.412 L1.649,49.9345 C1.5185,49.9785 1.384,50 1.25,50 Z M13.1093333,42.5368667 C13.3286667,42.5368667 13.5466,42.5989333 13.7360667,42.7198 C17.1054,44.8655333 21.0002,46 25,46 C36.5794,46 46,36.5794 46,25 C46,13.4206 36.5794,4 25,4 C13.4206,4 4,13.4206 4,25 C4,28.9998 5.13446667,32.8950667 7.28066667,36.2634667 C7.47013333,36.5616667 7.51493333,36.9289333 7.40246667,37.2635333 L4.6902,45.3098 L12.7369333,42.598 C12.8582667,42.5569333 12.9838,42.5368667 13.1093333,42.5368667 Z" id="Shape"></path>
            </g>
          </svg>
        </div>
        <div class="nav-text"><?php _e('Contactez-nous', 'guard-industrie') ?></div>
      </a>
      <?php endif; ?>  

      <div class="lang-selector">
         <?php
         if ( has_nav_menu( 'menu-pro') ) : 
         wp_nav_menu ( array (
         'theme_location' => 'language-menu',
         'menu_class' => 'lang-selector-list', 
         ) ); 
         endif;?>
     </div>
      
      
    </div>
</div>

    <div class="sub-menu <?php if($u_slug=="prescripteurs" || $u_slug=="industriels" ): ?>small<?php endif; ?>">
      <div class="sub-menu-wrapper  <?php if($u_slug=="prescripteurs"): ?>reversed<?php endif; ?>">
        <?php if($u_slug=="particuliers" || $u_slug=="pro-du-batiment"): ?>
        <div class="sub-menu-half">
          <div class="sub-menu-title">Par supports</div>
          <ul class="sub-menu-list support-list">
            <?php
            if($u_slug=="particuliers"){
               $ids=get_field('submenu_support_particuliers','options');
            }
            if($u_slug=="pro-du-batiment"){
               $ids=get_field('submenu_support_pro','options');
            }
            
            foreach ($ids as $id) : 
              $color = get_field( 'gamme_color', 'gamme_' . $id );
              if($u_slug=="particuliers"){
              $permalink = get_field( 'support_link_particulier', 'gamme_' . $id );
              }else{
              $permalink = get_field( 'support_link_pro', 'gamme_' . $id );         
              }
            ?>
            <li class="sub-menu-item">
              <a href="<?php echo $permalink ?>" class="sub-menu-link">
                
            <div class="sub-menu-mask">
            <div class="sub-menu-img-overlay" >
             <img src="/wp-content/uploads/2021/03/plus.svg"></img>
               </div>
              <img class="sub-menu-img" src="<?php the_cat_img($id,  [172, 172]); ?>"></img>
            </div>  
              
            <div> <?php echo get_term( $id )->name ?></div>
            </a>
            </li>
          <?php endforeach;?>
          </ul>
        </div>
        <div class="sub-menu-divider"></div>
        <?php endif; ?>
        <div class="sub-menu-half">
          <div class="sub-menu-title">Par gammes</div>
          
          <ul class="sub-menu-list">
            <?php
            if($u_slug=="particuliers"){
               $ids=get_field('submenu_gamme_particuliers','options');
            }
            if($u_slug=="pro-du-batiment"){
               $ids=get_field('submenu_gamme_pro','options');
            }
            if($u_slug=="industriels"){
               $ids=get_field('submenu_gamme_industriels','options');
            }
            if($u_slug=="prescripteurs"){
               $ids=get_field('submenu_gamme_prescripteurs','options');
            }
            
            $terms = get_terms('gamme');
            foreach ($ids as $id) : 
            $color = get_field( 'gamme_color', 'gamme_' . $id );
            if($u_slug=="particuliers"){
              $permalink = get_field( 'gamme_link_particulier', 'gamme_' . $id );
            }else{
              $permalink = get_field( 'gamme_link_pro', 'gamme_' . $id );        
            }
            ?>
            <li class="sub-menu-item">
              <a href="<?php echo $permalink ?>" class="sub-menu-link">
                <div class="sub-menu-mask">
                <div class="sub-menu-img-overlay" style="background-color:<?php echo $color;?>;">
                  <img src="/wp-content/uploads/2021/03/plus.svg"></img>
                </div>
    
              <img class="sub-menu-img" src="<?php the_cat_img(  $id , [172, 172]);  ?>"></img>
                        </div>
            <div> <?php echo get_term( $id )->name  ?></div>
            </a>
            </li>
          <?php endforeach;?>
          </ul>
          
        </div>
      </div>
</div>
   
        
    <div class="sub-menu-expertise">
      <div class="sub-menu-wrapper">
         <?php if($u_slug=="prescripteurs"): ?>
          <div class="sub-menu-half">
            <!--<div class="sub-menu-title">-->
            <!--  Expertises-->
            <!--</div>-->
            <ul class="sub-menu-list support-list">
               <?php $ids=get_field('submenu_expertise_prescripteurs','options');
                foreach ($ids as $post) : setup_postdata($post);?>
                <li class="sub-menu-item">
                  <a href=" <?php the_permalink(); ?>" class="sub-menu-link">
                    <div class="sub-menu-mask">
                    <div class="sub-menu-img-overlay" >
                     <img src="/wp-content/uploads/2021/03/plus.svg"></img>
                       </div>
                      <img class="sub-menu-img" src=" <?php the_post_thumbnail_url('medium') ?>"></img>
                    </div>  
                    <div><?php the_title(); ?></div>
                  </a>
                </li>
            <?php endforeach; wp_reset_postdata();?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="sub-menu-ressource">
      <div class="sub-menu-wrapper">
        <div class="sub-menu-half">
            <?php
            if($u_slug=="particuliers"){
              if ( has_nav_menu( 'menu-ressource_particuliers') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-ressource_particuliers' ,
               'menu_class' => 'sub-nav-ressource', 
               ) ); 
               endif;
            }
            if($u_slug=="pro-du-batiment"){
              if ( has_nav_menu( 'menu-ressource_pro') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-ressource_pro' ,
               'menu_class' => 'sub-nav-ressource', 
               ) ); 
               endif;
            }
            if($u_slug=="prescripteurs"){
              if ( has_nav_menu( 'menu-ressource_prescripteurs') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-ressource_prescripteurs' ,
               'menu_class' => 'sub-nav-ressource', 
               ) ); 
               endif;
            }
            if($u_slug=="industriels"){
              if ( has_nav_menu( 'menu-ressource_industriels') ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-ressource_industriels' ,
               'menu_class' => 'sub-nav-ressource', 
               ) ); 
               endif;
            }
           ?>
        </div>
        <div class="sub-menu-half">
          <div class="submenu-img-container">
            <img class="" src="<?php the_field('ressource_image','options') ?>"></img>
          </div>
        </div>
      </div>
    </div>
    
    <div class="sub-menu-projet">
      <div class="sub-menu-wrapper">
        <div class="sub-menu-half">
         <?php
               if ( has_nav_menu( 'menu-projets') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-projets' ,
                     'menu_class' => 'sub-nav-projet', 
                     ) ); 
               endif;
         ?>
        </div>
        <div class="sub-menu-half">
          <div class="submenu-img-container">
            <img class="" src="<?php the_field('projet_image','options') ?>"></img>
          </div>
        </div>
      </div>
    </div>

</div>
<div class="mobile-nav">
    <div class="nav-mobile-wrapper">
      <div class="nav-mobile-header">
        <div class="menu-burger">
          <div class="icon-open">

          <svg width="18px" height="16px" viewBox="0 0 18 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
              <defs>
                  <path d="M17.14428,8.30782178 L0.85536,8.30782178 C0.38376,8.30782178 0,8.69892029 0,9.179856 C0,9.66079171 0.38376,10.0518902 0.85536,10.0518902 L17.14428,10.0518902 C17.61624,10.0518902 18,9.66079171 18,9.179856 C18,8.69892029 17.61624,8.30782178 17.14428,8.30782178 M0.85536,3.54392444 L17.14428,3.54392444 C17.61624,3.54392444 18,3.15282593 18,2.67189022 C18,2.19095451 17.61624,1.799856 17.14428,1.799856 L0.85536,1.799856 C0.38376,1.799856 0,2.19095451 0,2.67189022 C0,3.15282593 0.38376,3.54392444 0.85536,3.54392444 M17.14428,14.8157876 L0.85536,14.8157876 C0.38376,14.8157876 0,15.2068861 0,15.687461 C0,16.1687575 0.38376,16.559856 0.85536,16.559856 L17.14428,16.559856 C17.61624,16.559856 18,16.1687575 18,15.687461 C18,15.2068861 17.61624,14.8157876 17.14428,14.8157876" id="path-1"></path>
              </defs>
              <g id="🔥-Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="component/mobile/header/pro" transform="translate(-15.000000, -57.000000)">
                      <g id="//-Header">
                          <g id="icon/menu" transform="translate(15.000000, 56.000000)">
                              <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-1"></use>
                              </mask>
                              <use id="icon" fill="#003A80" fill-rule="evenodd" xlink:href="#path-1"></use>
                          </g>
                      </g>
                  </g>
              </g>
          </svg>
          </div>
          <div class="icon-close">
            <svg width="100%" height="100%" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                <defs>
                    <path d="M49.3049,45.4492 L28.5829,25.0142 L49.2759,4.5462 C50.0939,3.6442 50.0819,2.1872 49.2489,1.3622 C48.7919,0.9102 48.1609,0.6562 47.5509,0.6852 C46.9549,0.7022 46.3929,0.9532 46.0249,1.3612 L25.2849,21.8142 L3.9769,0.6772 C3.5359,0.2402 2.9399,0.0002 2.2909,0.0002 L2.2789,0.0002 C1.6829,0.0162 1.1209,0.2682 0.7519,0.6772 C0.2989,1.1242 0.0489,1.7402 0.0649,2.3662 C0.0799,2.9612 0.3359,3.5212 0.7509,3.8872 L22.0469,25.0142 L0.6879,46.1422 C0.2349,46.5902 -0.0161,47.2062 0.0009,47.8312 C0.0159,48.4272 0.2719,48.9872 0.6879,49.3542 C1.1209,49.7822 1.6739,49.9992 2.3319,49.9992 C2.9909,49.9992 3.5439,49.7822 3.9759,49.3542 L25.3469,28.2162 L46.0239,48.6692 C46.4559,49.0962 47.0099,49.3142 47.6679,49.3142 C48.3259,49.3142 48.8799,49.0962 49.3119,48.6692 C49.7649,48.2202 50.0159,47.6042 49.9989,46.9792 C49.9839,46.3872 49.7299,45.8302 49.3049,45.4492" id="path-755"></path>
                </defs>
                <g id="🔥-Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="icon/close">
                        <mask id="mask-2" fill="white">
                            <use xlink:href="#path-755"></use>
                        </mask>
                        <use id="icon" fill="#322C2A" xlink:href="#path-755"></use>
                    </g>
                </g>
            </svg>
          </div>
        </div>
        <div class='logo-mobile-container'>
          <a href="<?php echo get_site_url(); ?>" class="logo w-inline-block"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png?v=1615988947611" loading="lazy" alt="" class="image"></a>
        </div>
        <?php include( locate_template( 'template-parts/sub-nav-right.php', false, false ) ); ?>
      </div>
      <div class="nav-mobile-container">
        <div class="nav-item-mobile <?php if($u_slug=="particuliers"){ echo "current"; }?>">
          <a class="nav-text-mobile has-mobile-menu" href="<?php the_field('homepage_particulier','options') ?>"><?php _e('Particuliers', 'guard-industrie') ?></a>
          <div class="sub-nav-mobile">
              <div class="sub-nav-header">

                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Particuliers', 'guard-industrie') ?></div>
              </div>
            <?php
               if ( has_nav_menu( 'menu-particulier' ) ) : 
               wp_nav_menu ( array (
               'theme_location' => 'menu-particulier' ,
               'menu_class' => 'sub-nav-left', 
               ) ); 
               endif;?>
          </div>
          
          <div class="sub-menu-mobile">
            <div class="sub-menu-wrapper-mobile">
              <div class="submenu-mobile-header">

                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Nos Produits', 'guard-industrie') ?></div>
              </div>
              <div class="submenu-main">
                <a href="<?php the_field('catalogue_particulier', 'option'); ?>">Tous les produits</a>

                <svg width="6px" height="11px" viewBox="0 0 6 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                    <defs>
                        <path d="M4.55503611,2.31463708 C4.05584592,1.80861042 3.65506308,1.0710118 3.3526876,0.10184122 C3.09893626,-0.15510779 2.34845422,0.124375739 2.24850906,0.385764473 C2.14856391,0.647153207 2.24850906,0.553617295 2.24850906,0.956741287 C2.59429944,2.03614242 2.96235895,2.77366344 3.3526876,3.16930436 C3.68452985,3.50566289 4.46689682,4.11589477 5.6997885,5 C4.4938633,6.14977028 3.71149633,6.90651675 3.3526876,7.2702394 C2.98938626,7.63851619 2.62132675,8.19547494 2.24850906,8.94111563 C2.07857735,9.18351764 2.12148316,9.29839105 2.24850906,9.59548337 C2.37553497,9.89257569 3.09893626,10.1852862 3.3526876,9.92805973 C3.78318753,9.13676366 4.18397037,8.48037126 4.55503611,7.95888252 C4.92610185,7.43739378 5.95942874,6.61443325 7.6550168,5.49000091 C7.783398,5.35986151 7.84526187,5.18754474 7.84252453,5.01495048 C7.84526187,4.8426337 7.783398,4.67003944 7.6550168,4.53990004 C6.06208398,3.53660003 5.02875708,2.79484571 4.55503611,2.31463708 Z" id="path-222"></path>
                    </defs>
                    <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="M---B.1.0---Menu" transform="translate(-311.000000, -144.000000)">
                            <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                <g id="items-1" transform="translate(42.000000, 29.000000)">
                                    <g id="icon/chevron" transform="translate(267.000000, 15.500000)">
                                        <mask id="mask-2" fill="white">
                                            <use xlink:href="#path-222"></use>
                                        </mask>
                                        <use id="icon-copy" fill="white" fill-rule="evenodd" xlink:href="#path-222"></use>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
              </div>
              <div class="sub-menu-half">
                <div class="sub-menu-title">Par supports</div>
                
                <ul class="sub-menu-list support-list">
                   <?php
                   $ids=get_field('submenu_support_particuliers','options');
                    
                    foreach ($ids as $id) : 
                        $color = get_field( 'gamme_color', 'gamme_' . $id );
                        $permalink = get_field( 'support_link_particulier', 'gamme_' . $id );
                  ?>
                  <li class="sub-menu-item">
                    <a href="<?php echo $permalink ?>" class="sub-menu-link">
                      <div class="submenu-mobile-content">
                        <div class="sub-menu-mask">
                          <img class="sub-menu-img" src="<?php the_cat_img($id,'small');  ?>"></img>
                        </div>  
                       <div><?php echo get_term( $id )->name ?></div>
                      </div>
                  </a>
                  </li>
                <?php endforeach;?>
                </ul>
              </div>
              <div class="sub-menu-half">
                <div class="sub-menu-title">Par gammes</div>
                <ul class="sub-menu-list">
                  <?php
                    $ids=get_field('submenu_gamme_particuliers','options');
                    foreach ($ids as $id) : 
                      $color = get_field( 'gamme_color', 'gamme_' . $id );
                      $permalink = get_field( 'gamme_link_particulier', 'gamme_' . $id );
                  ?>
                  <li class="sub-menu-item">
                    <a href="<?php echo $permalink ?>" class="sub-menu-link">
                      <div class="submenu-mobile-content">
                        <div class="sub-menu-mask">
                          <img class="sub-menu-img" src="<?php the_cat_img($id, [172, 172]);  ?>"></img>
                        </div>
                        <div><?php echo get_term( $id )->name ?></div>
                      </div>
                  </a>
                  </li>
                <?php endforeach;?>
                </ul>
              </div>
            </div>
          </div>
          <div class="sub-menu-ressource-mobile">
            <div class="sub-menu-wrapper-mobile">
              <div class="submenu-mobile-header">
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt">Ressources</div>
              </div>
               <?php 
                   if ( has_nav_menu( 'menu-ressource_particuliers') ) : 
                       wp_nav_menu ( array (
                       'theme_location' => 'menu-ressource_particuliers' ,
                       'menu_class' => 'sub-nav-ressource', 
                       ) ); 
                   endif;
               ?>
            </div>
          </div>
          <div class="sub-menu-projet-mobile">
            <div class="sub-menu-wrapper-mobile">
              <div class="submenu-mobile-header">
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt">Créer vos projets</div>
              </div>
              <?php 
                    if ( has_nav_menu( 'menu-projets') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-projets' ,
                     'menu_class' => 'sub-nav-projet', 
                     ) ); 
               endif;
               ?>
            </div>
          </div>
         </div>
         
        <?php if(get_field('nav_pro','options')): ?>
          <div class="nav-item-mobile <?php if($u_slug=="pro-du-batiment"){ echo "current"; }?>">
            <a class="nav-text-mobile has-mobile-menu" href="<?php the_field('homepage_pro','options') ?>"><?php _e('Pros du bâtiment', 'guard-industrie') ?></a>
              <div class="sub-nav-mobile">
                <div class="sub-nav-header">

                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Pros du bâtiment', 'guard-industrie') ?></div>
                </div>
                  <?php
                     if ( has_nav_menu( 'menu-pro') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-pro' ,
                     'menu_class' => 'sub-nav-left', 
                     ) ); 
                     endif;?>
              </div>
              <div class="sub-menu-mobile">
              <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">

                    <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                        <defs>
                            <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                        </defs>
                        <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                    <g id="items-1" transform="translate(42.000000, 24.000000)">
                                        <g id="back" transform="translate(3.000000, 0.000000)">
                                            <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-783"></use>
                                                </mask>
                                                <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <div class="sub-nav-header-txt"><?php _e('Nos Produits', 'guard-industrie') ?></div>
                </div>
                <div class="submenu-main">
                  <a href="<?php the_field('catalogue_pro', 'option'); ?>">Tous les produits</a>

                  <svg width="6px" height="11px" viewBox="0 0 6 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M4.55503611,2.31463708 C4.05584592,1.80861042 3.65506308,1.0710118 3.3526876,0.10184122 C3.09893626,-0.15510779 2.34845422,0.124375739 2.24850906,0.385764473 C2.14856391,0.647153207 2.24850906,0.553617295 2.24850906,0.956741287 C2.59429944,2.03614242 2.96235895,2.77366344 3.3526876,3.16930436 C3.68452985,3.50566289 4.46689682,4.11589477 5.6997885,5 C4.4938633,6.14977028 3.71149633,6.90651675 3.3526876,7.2702394 C2.98938626,7.63851619 2.62132675,8.19547494 2.24850906,8.94111563 C2.07857735,9.18351764 2.12148316,9.29839105 2.24850906,9.59548337 C2.37553497,9.89257569 3.09893626,10.1852862 3.3526876,9.92805973 C3.78318753,9.13676366 4.18397037,8.48037126 4.55503611,7.95888252 C4.92610185,7.43739378 5.95942874,6.61443325 7.6550168,5.49000091 C7.783398,5.35986151 7.84526187,5.18754474 7.84252453,5.01495048 C7.84526187,4.8426337 7.783398,4.67003944 7.6550168,4.53990004 C6.06208398,3.53660003 5.02875708,2.79484571 4.55503611,2.31463708 Z" id="path-222"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu" transform="translate(-311.000000, -144.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 29.000000)">
                                      <g id="icon/chevron" transform="translate(267.000000, 15.500000)">
                                          <mask id="mask-2" fill="white">
                                              <use xlink:href="#path-222"></use>
                                          </mask>
                                          <use id="icon-copy" fill="white" fill-rule="evenodd" xlink:href="#path-222"></use>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                </div>
                <div class="sub-menu-half">
                  <div class="sub-menu-title">Par supports</div>
                  <ul class="sub-menu-list support-list">
                   <?php
                   $ids=get_field('submenu_support_pro','options');
                    
                    foreach ($ids as $id) : 
                        $color = get_field( 'gamme_color', 'gamme_' . $id );
                        $permalink = get_field( 'support_link_pro', 'gamme_' . $id );
                  ?>
                  <li class="sub-menu-item">
                    <a href="<?php echo $permalink ?>" class="sub-menu-link">
                      <div class="submenu-mobile-content">
                        <div class="sub-menu-mask">
                          <img class="sub-menu-img" src="<?php the_cat_img($id, 'small');  ?>"></img>
                        </div>  
                       <div><?php echo get_term( $id )->name ?></div>
                      </div>
                  </a>
                  </li>
                <?php endforeach;?>
                </ul>
                </div>
                <div class="sub-menu-half">
                  <div class="sub-menu-title">Par gammes</div>
                  <ul class="sub-menu-list">
                  <?php
                    $ids=get_field('submenu_gamme_pro','options');
                    foreach ($ids as $id) : 
                      $color = get_field( 'gamme_color', 'gamme_' . $id );
                      $permalink = get_field( 'gamme_link_pro', 'gamme_' . $id );
                  ?>
                  <li class="sub-menu-item">
                    <a href="<?php echo $permalink ?>" class="sub-menu-link">
                      <div class="submenu-mobile-content">
                        <div class="sub-menu-mask">
                          <img class="sub-menu-img" src="<?php the_cat_img($id, [172, 172]);  ?>"></img>
                        </div>
                        <div><?php echo get_term( $id )->name ?></div>
                      </div>
                  </a>
                  </li>
                <?php endforeach;?>
                </ul>
                </div>
              </div>
            </div>
              <div class="sub-menu-ressource-mobile">
                <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">
                      <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                          <defs>
                              <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                          </defs>
                          <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                  <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                      <g id="items-1" transform="translate(42.000000, 24.000000)">
                                          <g id="back" transform="translate(3.000000, 0.000000)">
                                              <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                  <mask id="mask-2" fill="white">
                                                      <use xlink:href="#path-783"></use>
                                                  </mask>
                                                  <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      <div class="sub-nav-header-txt">Ressources</div>
                  </div>
                   <?php 
                       if ( has_nav_menu( 'menu-ressource_pro') ) : 
                           wp_nav_menu ( array (
                           'theme_location' => 'menu-ressource_pro' ,
                           'menu_class' => 'sub-nav-ressource', 
                           ) ); 
                       endif;
                   ?>
                </div>
              </div>
          </div>
        <?php endif; ?>
        
        <?php if(get_field('nav_prescripteurs','options')): ?>
        <div class="nav-item-mobile <?php if($u_slug=="prescripteurs"){ echo "current"; }?>">
          <a class="nav-text-mobile has-mobile-menu" href="<?php the_field('homepage_prescripteurs','options') ?>"><?php _e('Prescripteurs', 'guard-industrie') ?></a>
              <div class="sub-nav-mobile">
                <div class="sub-nav-header">
           
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Prescripteurs', 'guard-industrie') ?></div>
                </div>
                
                  <?php
                     if ( has_nav_menu( 'menu-prescripteurs') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-prescripteurs' ,
                     'menu_class' => 'sub-nav-left', 
                     ) ); 
                     endif;?>
              </div>
              <div class="sub-menu-mobile">
                <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">
     
                      <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                          <defs>
                              <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                          </defs>
                          <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                  <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                      <g id="items-1" transform="translate(42.000000, 24.000000)">
                                          <g id="back" transform="translate(3.000000, 0.000000)">
                                              <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                  <mask id="mask-2" fill="white">
                                                      <use xlink:href="#path-783"></use>
                                                  </mask>
                                                  <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      <div class="sub-nav-header-txt"><?php _e('Nos Produits', 'guard-industrie') ?></div>
                  </div>
                  <div class="submenu-main">
                    <a href="<?php the_field('catalogue_prescripteurs', 'option'); ?>">Tous les produits</a>
            
                    <svg width="6px" height="11px" viewBox="0 0 6 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                        <defs>
                            <path d="M4.55503611,2.31463708 C4.05584592,1.80861042 3.65506308,1.0710118 3.3526876,0.10184122 C3.09893626,-0.15510779 2.34845422,0.124375739 2.24850906,0.385764473 C2.14856391,0.647153207 2.24850906,0.553617295 2.24850906,0.956741287 C2.59429944,2.03614242 2.96235895,2.77366344 3.3526876,3.16930436 C3.68452985,3.50566289 4.46689682,4.11589477 5.6997885,5 C4.4938633,6.14977028 3.71149633,6.90651675 3.3526876,7.2702394 C2.98938626,7.63851619 2.62132675,8.19547494 2.24850906,8.94111563 C2.07857735,9.18351764 2.12148316,9.29839105 2.24850906,9.59548337 C2.37553497,9.89257569 3.09893626,10.1852862 3.3526876,9.92805973 C3.78318753,9.13676366 4.18397037,8.48037126 4.55503611,7.95888252 C4.92610185,7.43739378 5.95942874,6.61443325 7.6550168,5.49000091 C7.783398,5.35986151 7.84526187,5.18754474 7.84252453,5.01495048 C7.84526187,4.8426337 7.783398,4.67003944 7.6550168,4.53990004 C6.06208398,3.53660003 5.02875708,2.79484571 4.55503611,2.31463708 Z" id="path-222"></path>
                        </defs>
                        <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="M---B.1.0---Menu" transform="translate(-311.000000, -144.000000)">
                                <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                    <g id="items-1" transform="translate(42.000000, 29.000000)">
                                        <g id="icon/chevron" transform="translate(267.000000, 15.500000)">
                                            <mask id="mask-2" fill="white">
                                                <use xlink:href="#path-222"></use>
                                            </mask>
                                            <use id="icon-copy" fill="white" fill-rule="evenodd" xlink:href="#path-222"></use>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                  </div>
                  <div class="sub-menu-half">
                    <div class="sub-menu-title">Par gammes</div>
                    <ul class="sub-menu-list">
                    <?php
                      $ids=get_field('submenu_gamme_prescripteurs','options');
                      foreach ($ids as $id) : 
                        $color = get_field( 'gamme_color', 'gamme_' . $id );
                        $permalink = get_field( 'gamme_link_pro', 'gamme_' . $id );
                    ?>
                    <li class="sub-menu-item">
                      <a href="<?php echo $permalink ?>" class="sub-menu-link">
                        <div class="submenu-mobile-content">
                          <div class="sub-menu-mask">
                            <img class="sub-menu-img" src="<?php the_cat_img($id, [172, 172]);  ?>"></img>
                          </div>
                          <div><?php echo get_term( $id )->name ?></div>
                        </div>
                    </a>
                    </li>
                  <?php endforeach;?>
                  </ul>
                </div>
                </div>
              </div>
              <div class="sub-menu-ressource-mobile">
                <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">
                      <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                          <defs>
                              <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                          </defs>
                          <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                  <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                      <g id="items-1" transform="translate(42.000000, 24.000000)">
                                          <g id="back" transform="translate(3.000000, 0.000000)">
                                              <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                  <mask id="mask-2" fill="white">
                                                      <use xlink:href="#path-783"></use>
                                                  </mask>
                                                  <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      <div class="sub-nav-header-txt">Ressources</div>
                  </div>
                   <?php 
                       if ( has_nav_menu( 'menu-ressource_prescripteurs') ) : 
                           wp_nav_menu ( array (
                           'theme_location' => 'menu-ressource_prescripteurs' ,
                           'menu_class' => 'sub-nav-ressource', 
                           ) ); 
                       endif;
                   ?>
                </div>
              </div>
              
              <div class="sub-menu-expertise-mobile">
                <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">
                      <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                          <defs>
                              <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                          </defs>
                          <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                  <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                      <g id="items-1" transform="translate(42.000000, 24.000000)">
                                          <g id="back" transform="translate(3.000000, 0.000000)">
                                              <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                  <mask id="mask-2" fill="white">
                                                      <use xlink:href="#path-783"></use>
                                                  </mask>
                                                  <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      <div class="sub-nav-header-txt">Expertises</div>
                  </div>
                   <?php 
                       if ( has_nav_menu( 'menu-ressource_prescripteurs') ) : 
                           wp_nav_menu ( array (
                           'theme_location' => 'menu-expertise_prescripteurs' ,
                           'menu_class' => 'sub-nav-expertise', 
                           ) ); 
                       endif;
                   ?>
                </div>
              </div>
        </div>
        <?php endif; ?>

        <?php if(get_field('nav_industriel','options')): ?>      
        <div class="nav-item-mobile <?php if($u_slug=="industriels"){ echo "current"; }?>">
          <a class="nav-text-mobile has-mobile-menu" href="<?php the_field('homepage_industriel','options') ?>"><?php _e('Industriels', 'guard-industrie') ?></a>
              <div class="sub-nav-mobile">
                <div class="sub-nav-header">
                  
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Industriels', 'guard-industrie') ?></div>
                </div>
                  <?php
                     if ( has_nav_menu( 'menu-industriels') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-industriels' ,
                     'menu_class' => 'sub-nav-left', 
                     ) ); 
                     endif;?>
              </div>
              <div class="sub-menu-mobile">
              <div class="sub-menu-wrapper-mobile">
                <div class="submenu-mobile-header">
             
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Nos Produits', 'guard-industrie') ?></div>
                </div>
                <div class="submenu-main">
                  <a href="<?php the_field('catalogue_industriels', 'option'); ?>">Tous les produits</a>
                 
                  <svg width="6px" height="11px" viewBox="0 0 6 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M4.55503611,2.31463708 C4.05584592,1.80861042 3.65506308,1.0710118 3.3526876,0.10184122 C3.09893626,-0.15510779 2.34845422,0.124375739 2.24850906,0.385764473 C2.14856391,0.647153207 2.24850906,0.553617295 2.24850906,0.956741287 C2.59429944,2.03614242 2.96235895,2.77366344 3.3526876,3.16930436 C3.68452985,3.50566289 4.46689682,4.11589477 5.6997885,5 C4.4938633,6.14977028 3.71149633,6.90651675 3.3526876,7.2702394 C2.98938626,7.63851619 2.62132675,8.19547494 2.24850906,8.94111563 C2.07857735,9.18351764 2.12148316,9.29839105 2.24850906,9.59548337 C2.37553497,9.89257569 3.09893626,10.1852862 3.3526876,9.92805973 C3.78318753,9.13676366 4.18397037,8.48037126 4.55503611,7.95888252 C4.92610185,7.43739378 5.95942874,6.61443325 7.6550168,5.49000091 C7.783398,5.35986151 7.84526187,5.18754474 7.84252453,5.01495048 C7.84526187,4.8426337 7.783398,4.67003944 7.6550168,4.53990004 C6.06208398,3.53660003 5.02875708,2.79484571 4.55503611,2.31463708 Z" id="path-222"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu" transform="translate(-311.000000, -144.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 29.000000)">
                                      <g id="icon/chevron" transform="translate(267.000000, 15.500000)">
                                          <mask id="mask-2" fill="white">
                                              <use xlink:href="#path-222"></use>
                                          </mask>
                                          <use id="icon-copy" fill="white" fill-rule="evenodd" xlink:href="#path-222"></use>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                </div>
                <div class="sub-menu-half industriels">
                  <div class="sub-menu-title">Par gammes</div>
                  <ul class="sub-menu-list">
                  <?php
                    $ids=get_field('submenu_gamme_industriels','options');
                    foreach ($ids as $id) : 
                      $color = get_field( 'gamme_color', 'gamme_' . $id );
                      $permalink = get_field( 'gamme_link_pro', 'gamme_' . $id );
                  ?>
                  <li class="sub-menu-item">
                    <a href="<?php echo $permalink ?>" class="sub-menu-link">
                      <div class="submenu-mobile-content">
                        <div class="sub-menu-mask">
                          <img class="sub-menu-img" src="<?php the_cat_img($id, [172, 172]);  ?>"></img>
                        </div>
                        <div><?php echo get_term( $id )->name ?></div>
                      </div>
                  </a>
                  </li>
                <?php endforeach;?>
                </ul>
                </div>
              </div>
            </div>
              <div class="sub-menu-ressource-mobile">
                <div class="sub-menu-wrapper-mobile">
                  <div class="submenu-mobile-header">
                      <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                          <defs>
                              <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                          </defs>
                          <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                                  <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                      <g id="items-1" transform="translate(42.000000, 24.000000)">
                                          <g id="back" transform="translate(3.000000, 0.000000)">
                                              <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                                  <mask id="mask-2" fill="white">
                                                      <use xlink:href="#path-783"></use>
                                                  </mask>
                                                  <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      <div class="sub-nav-header-txt">Ressources</div>
                  </div>
                   <?php 
                       if ( has_nav_menu( 'menu-ressource_industriels') ) : 
                           wp_nav_menu ( array (
                           'theme_location' => 'menu-ressource_industriels' ,
                           'menu_class' => 'sub-nav-ressource', 
                           ) ); 
                       endif;
                   ?>
                </div>
              </div>
        </div>
        <?php endif; ?>
         
        <div class="mobile-separator"></div>
        <div class ='bottom-nav-container'>
          <?php if(get_field('la_marque','options')): ?> 
            <div class="nav-item-mobile <?php if($u_slug=="la-marque"){ echo "current"; }?>">
              <a href="<?php the_field('lien_page_marque','options'); ?>" class="nav-text-mobile has-mobile-menu w-inline-block">
                <div class="mobile-txt-container">
                  <div class="icon-nav w-embed">
                    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#003A80">
                      <g id="icon/brand" stroke="none" stroke-width="1">
                        <path d="M25.0086097,0 C35.9545552,0 46.8988693,1.53937048 50,4.62137358 L50,4.62137358 L50,18.2904905 C50,25.8791484 47.3683257,33.001863 42.2160877,39.4581938 C38.0324886,44.6799835 29.3310519,50 24.9747146,50 C20.5699816,50 11.8669137,44.6779899 7.72010977,39.4417018 C2.54013942,33.0883099 0,25.9723008 0,18.2904905 L0,18.2904905 L0,4.62137358 C3.0989556,1.54154524 14.0545077,0 25.0086097,0 Z M25.0068878,4 C16.2436061,4 7.47916448,5.23323619 5,7.69709886 L5,19.6323924 C5,25.7778406 7.03211154,31.4706479 11.1760878,36.5533615 C14.4935309,40.742392 21.4559853,45 24.9797717,45 C28.4648415,45 35.4259908,40.7439868 38.7728701,36.566555 C42.8946605,31.4014904 45,25.7033187 45,19.6323924 L45,7.69709886 C42.5190955,5.23149638 33.7636441,4 25.0068878,4 Z" id="Combined-Shape"></path>
                      </g>
                    </svg>
                  </div>
                  <div class="nav-text-m"><?php _e('La marque', 'guard-industrie') ?></div>
                </div>
              </a>
              <div class="sub-nav-mobile">
                <div class="sub-nav-header">
                  
                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt">La marque</div>
                </div>
                  <?php
                     if ( has_nav_menu( 'menu-marque') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-marque' ,
                     'menu_class' => 'sub-nav-left', 
                     ) ); 
                     endif;?>
                     
                     
              </div>
            </div>
          <?php endif; ?>
      
          <?php if(get_field('nos_references','options')): ?> 
            <div class="nav-item-mobile <?php if($u_slug=="reference"){ echo "current"; }?>">
              <a href="<?php the_field('lien_page_references','options'); ?>" class="nav-text-mobile has-mobile-menu w-inline-block">
                <div class="mobile-txt-container">
                  <div class="icon-nav w-embed">
                    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg fill="#003A80" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g id="icon/reference" stroke="none" stroke-width="1">
                        <g id="Group" transform="translate(30.000000, 3.000000)"></g>
                        <path d="M34.52791,0.6927 C34.5052761,0.6927 34.4869257,0.7110504 34.4869257,0.7336843 C34.4869257,0.7563221 34.5052761,0.7746725 34.52791,0.7746725 L35.084697,0.7746725 L35.084697,1.3314635 C35.084697,1.3540974 35.1030474,1.3724478 35.1256852,1.3724478 C35.1483191,1.3724478 35.1666695,1.3540974 35.1666695,1.3314635 L35.1666695,0.7336835 C35.1666695,0.7110496 35.1483191,0.6926992 35.1256852,0.6926992 L34.5279092,0.6926992 L34.52791,0.6927 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M30.80543,0.77467 C30.8280639,0.77467 30.8464143,0.7563196 30.8464143,0.7336818 C30.8464143,0.7110479 30.8280639,0.6926975 30.80543,0.6926975 L30.207654,0.6926975 C30.1850201,0.6926975 30.1666697,0.7110479 30.1666697,0.7336818 L30.1666697,1.3314618 C30.1666697,1.3540957 30.1850201,1.3724461 30.207654,1.3724461 C30.2302918,1.3724461 30.2486422,1.3540957 30.2486422,1.3314618 L30.2486422,0.7746708 L30.8054292,0.7746708 L30.80543,0.77467 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M34.52791,4.55867 C34.5052761,4.55867 34.4869257,4.5770204 34.4869257,4.5996582 C34.4869257,4.6222921 34.5052761,4.6406425 34.52791,4.6406425 L35.125686,4.6406425 C35.1483199,4.6406425 35.1666703,4.6222921 35.1666703,4.5996582 L35.1666703,4.0018782 C35.1666703,3.9792443 35.1483199,3.9608939 35.125686,3.9608939 C35.1030482,3.9608939 35.0846978,3.9792443 35.0846978,4.0018782 L35.0846978,4.5586692 L34.5279108,4.5586692 L34.52791,4.55867 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M30.80543,4.64064 C30.8280639,4.64064 30.8464143,4.6222896 30.8464143,4.5996557 C30.8464143,4.5770179 30.8280639,4.5586675 30.80543,4.5586675 L30.248643,4.5586675 L30.248643,4.0018765 C30.248643,3.9792426 30.2302926,3.9608922 30.2076548,3.9608922 C30.1850209,3.9608922 30.1666705,3.9792426 30.1666705,4.0018765 L30.1666705,4.5996565 C30.1666705,4.6222904 30.1850209,4.6406408 30.2076548,4.6406408 L30.8054308,4.6406408 L30.80543,4.64064 Z" id="Path" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M20.4991322,7 C21.3999494,7 22.1918973,7.62563362 22.4406061,8.53375161 L22.8584095,10.065626 C24.9379717,17.7998312 30.7004933,23.8445467 38.0741233,26.0264618 L39.5366371,26.4646846 C40.4002852,26.7237641 40.9967602,27.5503155 41,28.4924877 C41.0032135,29.4346598 40.4124152,30.2656844 39.5505638,30.531265 L37.8514967,31.0564972 C30.1054032,33.4480067 24.2128428,40.0697912 22.4714872,48.3398343 C22.2716336,49.28533 21.4863613,49.9686127 20.5635183,50 L20.4991322,50 C19.5988177,49.9991708 18.8076232,49.373384 18.5596767,48.4655852 L18.1416714,46.9358278 C16.0608225,39.2022006 10.2983948,33.1580646 2.92515031,30.9754154 L1.46263655,30.5371926 C0.596657851,30.2764538 0,29.445712 0,28.5007269 C0,27.5557418 0.596657851,26.725 1.46263655,26.4642612 L2.92313193,26.0260384 C10.29655,23.8449103 16.0593803,17.801234 18.1398549,10.067743 L18.5576583,8.53375161 C18.8063671,7.62563362 19.598315,7 20.4991322,7 Z M20.4957948,16 C18.1158894,21.5009063 14.0511598,25.9274002 9,28.5189298 C14.0398709,31.1041826 18.0974901,35.5161693 20.4793476,41 C22.8891618,35.5233751 26.9575725,31.1178865 32,28.5248327 C26.9447229,25.9336513 22.8766945,21.5047165 20.4957948,16 Z M40.8597381,20.079681 C40.071255,20.0804283 39.3780942,19.4996484 39.1619191,18.6571254 L38.9979503,18.0224139 C38.2769741,15.1757639 36.274769,12.9510916 33.712784,12.1500068 L33.1399534,11.9660524 C32.3820846,11.7251502 31.8596712,10.9553463 31.8596712,10.0794886 C31.8596712,9.20363097 32.3820846,8.43382711 33.1399534,8.19292488 L33.7110171,8.01073734 C36.2730742,7.20978944 38.2753303,4.98506046 38.9961834,2.13833033 L39.1619191,1.50263716 C39.3786124,0.660487089 40.0714352,0.0799269237 40.8597381,0.0799269237 C41.6480411,0.0799269237 42.3408639,0.660487089 42.5575572,1.50263716 L42.721526,2.13734871 C43.4425022,4.98399871 45.4447073,7.208671 48.0066923,8.00975573 L48.5795229,8.19371017 C49.3354515,8.43441004 49.8572475,9.20121592 49.8596712,10.0749413 C49.862078,10.9486667 49.3445313,11.7190196 48.5899476,11.9648745 L47.9255913,12.1808295 C45.235809,13.0614195 43.1898931,15.4977214 42.5852976,18.540117 C42.4103437,19.4169273 41.7229084,20.0505731 40.9150423,20.079681 L40.8597381,20.079681 Z M40.9671925,15.1912829 C42.0461095,13.2342812 43.4035016,11.5424486 44.9715779,10.2002787 C43.4007127,8.85565299 42.0433287,7.15711177 40.9686543,5.19128293 C39.896533,7.15568606 38.5409771,8.85245623 36.9715779,10.1944848 C38.5392995,11.5358345 39.8941795,13.2302076 40.9671925,15.1912829 Z" id="Shape"></path>
                      </g>
                    </svg>
                  </div>
                  <div class="nav-text-m"><?php _e('Nos références', 'guard-industrie') ?></div>
                </div>
              </a>
              <div class="sub-nav-mobile">
                <div class="sub-nav-header">

                  <svg width="12px" height="10px" viewBox="0 0 12 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                      <defs>
                          <path d="M9.13998047,3.77080078 C8.70570733,3.33058022 8.41507172,2.68890242 8.26807364,1.84576737 C8.04732132,1.62223323 7.30797766,1.86537139 7.22102985,2.0927679 C7.13408203,2.32016441 7.12171875,2.23879235 7.12171875,2.58949219 C7.31433779,3.25252885 7.58043154,3.75614213 7.92,4.10033203 C8.20868791,4.39294891 8.75570106,4.87166981 9.56103945,5.53649473 L0.565835757,5.53649473 C0.253877254,5.53649473 2.4e-05,5.79816969 2.4e-05,6.11995265 C2.4e-05,6.4417356 0.253877254,6.70341056 0.565835757,6.70341056 L9.56080132,6.70341056 C8.77908131,7.3060165 8.23214754,7.76553069 7.92,8.08195313 C7.60394408,8.40233746 7.33785033,8.77087262 7.12171875,9.18755859 C6.97388576,9.3984375 6.84890721,9.67236328 6.95941406,9.93082031 C7.06992092,10.1892773 7.80732132,10.6179135 8.02807364,10.3941379 C8.35187731,9.55926465 8.72251292,8.9302356 9.13998047,8.50705078 C9.56890211,8.07225501 10.4678503,7.41431317 11.836825,6.53322528 C11.9485109,6.42000982 12.0023297,6.27010193 12.000024,6.11995265 C12.0023297,5.97004476 11.9485109,5.81989548 11.836825,5.70668002 C10.4510447,4.83385389 9.55209652,4.18856081 9.13998047,3.77080078 Z" id="path-783"></path>
                      </defs>
                      <g id="B---Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="M---B.1.0---Menu---Sous-menu" transform="translate(-45.000000, -133.000000)">
                              <g id="Menu-deploy" transform="translate(-0.000000, 100.000000)">
                                  <g id="items-1" transform="translate(42.000000, 24.000000)">
                                      <g id="back" transform="translate(3.000000, 0.000000)">
                                          <g id="icon/arrow" transform="translate(6.000000, 14.000000) rotate(180.000000) translate(-6.000000, -14.000000) translate(0.000000, 8.000000)">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-783"></use>
                                              </mask>
                                              <use id="icon-copy" fill="#003A80" fill-rule="evenodd" xlink:href="#path-783"></use>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                  <div class="sub-nav-header-txt"><?php _e('Nos références', 'guard-industrie') ?></div>
                </div>
                  <?php
                     if ( has_nav_menu( 'menu-reference') ) : 
                     wp_nav_menu ( array (
                     'theme_location' => 'menu-reference' ,
                     'menu_class' => 'sub-nav-left', 
                     ) ); 
                     endif;?>
                     
                     
              </div>
            </div>
          <?php endif; ?>      
      
          <?php if(get_field('contactez-nous','options')): ?>   
            <div class="nav-item-mobile <?php if($u_slug=="contact"){ echo "current"; }?>">
              <a href="<?php the_field('lien_page_contact','options'); ?>" class="nav-text-mobile" >
                <div class="mobile-txt-container">
                  <div class="icon-nav w-embed">
                    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#003A80">
                      <g id="icon/question" stroke="none" stroke-width="1">
                        <path d="M1.25,50 C0.9235,50 0.604,49.872 0.366,49.634 C0.03,49.298 -0.0865,48.801 0.065,48.351 L3.5875,37.899 C1.239,34.007 -0.000371523443,29.561 -0.000371523443,25 C-0.000371523443,11.215 11.215,0 25,0 C38.785,0 50,11.215 50,25 C50,38.785 38.785,50 25,50 C20.4395,50 15.993,48.761 12.1015,46.412 L1.649,49.9345 C1.5185,49.9785 1.384,50 1.25,50 Z M13.1093333,42.5368667 C13.3286667,42.5368667 13.5466,42.5989333 13.7360667,42.7198 C17.1054,44.8655333 21.0002,46 25,46 C36.5794,46 46,36.5794 46,25 C46,13.4206 36.5794,4 25,4 C13.4206,4 4,13.4206 4,25 C4,28.9998 5.13446667,32.8950667 7.28066667,36.2634667 C7.47013333,36.5616667 7.51493333,36.9289333 7.40246667,37.2635333 L4.6902,45.3098 L12.7369333,42.598 C12.8582667,42.5569333 12.9838,42.5368667 13.1093333,42.5368667 Z" id="Shape"></path>
                      </g>
                    </svg>
                  </div>
                  <div class="nav-text-m"><?php _e('Contactez-nous', 'guard-industrie') ?></div>
                </div>
              </a>
            </div>
          <?php endif; ?>  
        </div> 
    
        <div class="lang-selector-mobile">
           <?php
             if ( has_nav_menu( 'menu-pro') ) : 
             wp_nav_menu ( array (
             'theme_location' => 'language-menu',
             'menu_class' => 'lang-selector-list-mobile', 
             ) ); 
           endif;?>
        </div>
         
      </div>
    </div>
</div>


<?php 


// generate breadcrumb data
$breadcrumb_data = get_breadcrumb_data(); 

?>

</nav> <!-- early closing former <nav>, before breadcrumbs -->
<?= dom_breadcrumb($breadcrumb_data) ?>

<!-- Guard JSON-LD breadcrumbs -->
<script type="application/ld+json"><?= jsonld_breadcrumb($breadcrumb_data) ?></script>

<?php
  if ( !guardindustrie_location_cookie_exists() && guardindustrie_get_location_cookie_value() !== "FR" ) { // you can remove the second "!" for testing purpose
    get_template_part( 'template-parts/switch-country-popin' ); 
  }