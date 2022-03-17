<?php include( locate_template( 'template-parts/sticky-nav.php', false, false ) ); ?>
  <div class="section-gi-with-you">
    <span class="main-title-white spacer"><?php the_field('footer_top_text','options'); ?></span>
    <div class="gwy-subtitle">
      <p class="paragraph-white"><?php _e('VOUS ÊTES UN :', 'guard-industrie') ?></p>
    </div>
    <div class="main-wrapper">
      <ul role="list" class="gwy-list w-list-unstyled">
        <li class="gwy-item <?php if($u_slug=="particulier"){ echo "w--current"; }?>">
          <a href="<?php the_field('homepage_particulier','options') ?>" class="gwy-wrapper <?php if($u_slug=="particuliers"){ echo "w--current"; }?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gwy-particulier.svg?v=1615988947611" loading="lazy" alt="" class="gwy-picto">
            <div class="subtitle-white"><?php _e('Particulier', 'guard-industrie') ?></div>
          </a>
        </li>
        <li class="gwy-item">
          <a href="<?php the_field('homepage_pro','options') ?>" class="gwy-wrapper <?php if($u_slug=="pro-du-batiment"){ echo "w--current"; }?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gwy-pro.svg?v=1615988947611" loading="lazy" alt="" class="gwy-picto">
            <div class="subtitle-white"><?php _e('Pro du bâtiment', 'guard-industrie') ?></div>
          </a>
        </li>
        
        <?php if(get_field('nav_prescripteurs','options')): ?>
        <li class="gwy-item">
         <a href="<?php the_field('homepage_prescripteurs','options') ?>" class="gwy-wrapper <?php if($u_slug=="prescripteurs"){ echo "w--current"; }?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gwy-prescripteur.svg?v=1615988947611" loading="lazy" alt="" class="gwy-picto">
            <div class="subtitle-white"><?php _e('Prescripteur', 'guard-industrie') ?></div>
          </a>
        </li>
       <?php endif; ?>
       
        <?php if(get_field('nav_industriel','options')): ?>      
        <li class="gwy-item">
          <a href="<?php the_field('homepage_industriel','options') ?>" class="gwy-wrapper <?php if($u_slug=="industriels"){ echo "w--current"; }?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gwy-industriel.svg?v=1615988947611" loading="lazy" alt="" class="gwy-picto">
            <div class="subtitle-white"><?php _e('Industriel', 'guard-industrie') ?></div>
          </a>
        </li>
       <?php endif; ?>
       
      </ul>
      <div class="gwy-banner">
        <div class="gwy-banner-text"><?php the_field('footer_under_text','options'); ?></div>
      </div>
    </div>
  </div>
  <div class="footer-block">
    <div class="section-newsletter">
      <span class="main-title-white newsletter-title"><?php _e('Newsletter', 'guard-industrie') ?></span>
      <div class="newsletter-form w-form">
        <form id="email-form" name="email-form" data-name="Email Form" class="form">
          <div class="form-buttons"><label class="radio-button-field w-radio">
              <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-button w-radio-input"></div><input type="radio" data-name="Radio 5" id="radio-5" name="radio" value="Radio" style="opacity:0;position:absolute;z-index:-1"><span class="radio-button-label w-form-label"><?php _e('JE SUIS UN PARTICULIER', 'guard-industrie') ?></span>
            </label><label class="radio-button-field w-radio">
              <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-button w-radio-input"></div><input type="radio" data-name="Radio 6" id="radio-6" name="radio" value="Radio" style="opacity:0;position:absolute;z-index:-1"><span class="radio-button-label w-form-label"><?php _e('JE SUIS UN PRO DU bâtiment', 'guard-industrie') ?></span>
            </label><label class="radio-button-field w-radio">
              <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-button w-radio-input"></div><input type="radio" data-name="Radio 7" id="radio-7" name="radio" value="Radio" style="opacity:0;position:absolute;z-index:-1"><span class="radio-button-label w-form-label"><?php _e('JE SUIS UN prescripteur', 'guard-industrie') ?></span>
            </label><label class="radio-button-field w-radio">
              <div class="w-form-formradioinput w-form-formradioinput--inputType-custom radio-button w-radio-input"></div><input type="radio" data-name="Radio 8" id="radio-8" name="radio" value="Radio" style="opacity:0;position:absolute;z-index:-1"><span class="radio-button-label w-form-label"><?php _e('JE SUIS UN industriel', 'guard-industrie') ?></span>
            </label></div><input type="email" class="text-field-5 w-input" maxlength="256" name="field-2" data-name="Field 2" placeholder="Votre adresse email" id="field-2" required=""><input type="submit" value="m'inscrire à la newsletter" data-wait="Please wait..." class="submit-button w-button">
        </form>
        <div class="w-form-done">
          <div><?php _e('Thank you! Your submission has been received!', 'guard-industrie') ?></div>
        </div>
        <div class="w-form-fail">
          <div><?php _e('Oops! Something went wrong while submitting the form.', 'guard-industrie') ?></div>
        </div>
      </div>
      <div class="newsletter-inner"><?php echo do_shortcode("[sibwp_form id=2]"); ?></div>
    </div>
    <div class="footer-bottom">
      <div class="footer-logo-container"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png?v=1615988947611" loading="lazy" alt="" class="footer-logo"></div>
      <div class="footer-contianer">
        <div class="footer-row">
          <div class="footer-left">
            
            <?php if(get_field('nav_particulier','options')): ?>
            <div class="footer-item">
              <a href="<?php the_field('homepage_particulier','options') ?>"><?php _e('Particuliers', 'guard-industrie') ?></a>
            </div>
            <?php endif; ?>

            
            <?php if(get_field('nav_pro','options')): ?>
            <div class="footer-item">
              <a href="<?php the_field('homepage_pro','options') ?>"><?php _e('Pros du bâtiment', 'guard-industrie') ?></a>
            </div>
                  <?php endif; ?>
            
            <?php if(get_field('nav_prescripteurs','options')): ?>
            <div class="footer-item">
             <a href="<?php the_field('homepage_prescripteurs','options') ?>"><?php _e('Prescripteurs', 'guard-industrie') ?></a>
            </div>
                  <?php endif; ?>
            
            <?php if(get_field('nav_industriel','options')): ?>
            <div class="footer-item">
              <a href="<?php the_field('homepage_industriel','options') ?>"><?php _e('Industriels', 'guard-industrie') ?></a>
            </div>
                  <?php endif; ?>
            
          </div>
          <div class="footer-right">
            <?php if(get_field('lien_facebook', 'option')): ?>
            <a href="<?php the_field('lien_facebook', 'option'); ?>" class="social-item w-inline-block"  target="_blank" data-trk-social="facebook">
              <div class="social-picto w-embed">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g id="icon/social/fb" stroke="none" stroke-width="1">
                    <path d="M36.233285,16.1902298 L28.3208445,16.1902298 L28.3208445,11.000828 C28.3208445,9.05195612 29.6125026,8.59759884 30.5222521,8.59759884 C31.4299317,8.59759884 36.1059822,8.59759884 36.1059822,8.59759884 L36.1059822,0.0300144898 L28.4160629,0 C19.879528,0 17.9368661,6.38998137 17.9368661,10.4791969 L17.9368661,16.1902298 L13,16.1902298 L13,25.0186297 L17.9368661,25.0186297 C17.9368661,36.3485821 17.9368661,50 17.9368661,50 L28.3208445,50 C28.3208445,50 28.3208445,36.2140344 28.3208445,25.0186297 L35.3276754,25.0186297 L36.233285,16.1902298 Z" id="Path"></path>
                  </g>
                </svg>
              </div>
            </a>
            <?php endif; ?>
            
            <?php if(get_field('lien_youtube', 'option')): ?>
            <a href="<?php the_field('lien_youtube', 'option');?>" class="social-item w-inline-block"  target="_blank" data-trk-social="youtube">
              <div class="social-picto w-embed"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-21 -117 682.66672 682">
                  <path d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0"></path>
                </svg></div>
            </a>
            <?php endif; ?>  
            
            <?php if(get_field('lien_twitter', 'option')): ?>
            <a href="<?php the_field('lien_twitter', 'option');?>" class="social-item w-inline-block"  target="_blank" data-trk-social="twitter">
              <div class="social-picto w-embed">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g id="icon/social/twitter" stroke="none" stroke-width="1">
                    <path d="M50,9.80989789 C48.1619065,10.6269411 46.1837485,11.1780647 44.1081542,11.4247001 C46.2273918,10.1559994 47.8523435,8.14637761 48.6186387,5.74904086 C46.6364208,6.9253801 44.4420762,7.7789619 42.1046221,8.23975397 C40.2340499,6.24637152 37.5677486,5 34.6172584,5 C28.9527637,5 24.3600674,9.59269634 24.3600674,15.258206 C24.3600674,16.0610397 24.4503989,16.8435743 24.625987,17.59566 C16.1003187,17.1673467 8.54089276,13.0841605 3.48131458,6.87767696 C2.59829893,8.39199805 2.09284859,10.1539695 2.09284859,12.0357063 C2.09284859,15.5941579 3.90353815,18.7344457 6.65611108,20.5735542 C4.97533646,20.5197613 3.39301301,20.0579542 2.00962183,19.2896291 C2.00860687,19.3322575 2.00860687,19.3759008 2.00860687,19.4195441 C2.00860687,24.3887908 5.54472931,28.5338895 10.2379067,29.4778028 C9.37722023,29.7112437 8.47086048,29.8370988 7.53506689,29.8370988 C6.87331263,29.8370988 6.23084262,29.7731563 5.60461198,29.652376 C6.91086617,33.7274425 10.6986988,36.6941721 15.1868542,36.7763839 C11.6761058,39.5279419 7.25392282,41.1681181 2.44706981,41.1681181 C1.61987699,41.1681181 0.80283377,41.1194 0,41.0239937 C4.54093336,43.9359154 9.93240363,45.6329294 15.7247833,45.6329294 C34.5939143,45.6329294 44.910988,30.0025374 44.910988,16.4467247 C44.910988,16.002172 44.9018533,15.5586343 44.8825691,15.1181414 C46.8861011,13.6748675 48.6257435,11.8672229 50,9.80989789 Z" id="Path"></path>
                  </g>
                </svg>
              </div>
            </a>
            <?php endif; ?>
            
            <?php if(get_field('lien_linkedin', 'option')): ?>
            <a href="<?php the_field('lien_linkedin', 'option');?>" class="social-item w-inline-block"  target="_blank" data-trk-social="linkedin">
              <div class="social-picto w-embed">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g id="icon/social/linkedin" stroke="none" stroke-width="1">
                    <path d="M50,30.269802 L50,47.9059406 C50,48.3391089 49.6287129,48.710396 49.1955446,48.710396 L40.0990099,48.710396 C39.6658416,48.710396 39.2945545,48.3391089 39.2945545,47.9059406 L39.2945545,31.5074257 C39.2945545,27.1757426 37.7475248,24.2054455 33.8490099,24.2054455 C30.8787129,24.2054455 29.1460396,26.1856436 28.3415842,28.1039604 C28.0321782,28.7846535 27.970297,29.7747525 27.970297,30.7029703 L27.970297,47.9059406 C27.970297,48.3391089 27.5990099,48.710396 27.1658416,48.710396 L18.1311881,48.710396 C17.6980198,48.710396 17.3267327,48.3391089 17.3267327,47.9059406 C17.3267327,43.5123762 17.450495,22.2871287 17.3267327,17.3366337 C17.3267327,16.9034653 17.6980198,16.5321782 18.1311881,16.5321782 L27.2277228,16.5321782 C27.6608911,16.5321782 28.0321782,16.9034653 28.0321782,17.3366337 L28.0321782,21.1113861 C28.0321782,21.1732673 27.970297,21.1732673 27.970297,21.2351485 L28.0321782,21.2351485 L28.0321782,21.1113861 C29.4554455,18.9455446 31.9925743,15.789604 37.6856436,15.789604 C44.740099,15.789604 50,20.4306931 50,30.269802 L50,30.269802 Z M10.5816832,16.5321782 C11.0148515,16.5321782 11.3861386,16.9034653 11.3861386,17.3366337 L11.3861386,17.3366337 L11.3861386,47.9678218 C11.3861386,48.4009901 11.0148515,48.7722772 10.5816832,48.7722772 L10.5816832,48.7722772 L1.48514851,48.7722772 C1.0519802,48.7722772 0.742574257,48.4009901 0.680693069,47.9678218 L0.680693069,47.9678218 L0.680693069,17.3366337 C0.680693069,16.9034653 1.0519802,16.5321782 1.48514851,16.5321782 L1.48514851,16.5321782 Z M5.7549505,1 C8.93332189,1 11.509901,3.5765791 11.509901,6.7549505 C11.509901,9.93332189 8.93332189,12.509901 5.7549505,12.509901 C2.5765791,12.509901 0,9.93332189 0,6.7549505 C0,3.5765791 2.5765791,1 5.7549505,1 Z" id="XMLID_18_"></path>
                  </g>
                </svg>
              </div>
            </a>
            <?php endif; ?>
             
            <?php if(get_field('lien_instagram', 'option')): ?>
            <a href="<?php the_field('lien_instagram', 'option');?>" class="social-item w-inline-block" target="_blank" data-trk-social="instagram">
              <div class="social-picto w-embed"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511 511.9">
                  <path d="m510.949219 150.5c-1.199219-27.199219-5.597657-45.898438-11.898438-62.101562-6.5-17.199219-16.5-32.597657-29.601562-45.398438-12.800781-13-28.300781-23.101562-45.300781-29.5-16.296876-6.300781-34.898438-10.699219-62.097657-11.898438-27.402343-1.300781-36.101562-1.601562-105.601562-1.601562s-78.199219.300781-105.5 1.5c-27.199219 1.199219-45.898438 5.601562-62.097657 11.898438-17.203124 6.5-32.601562 16.5-45.402343 29.601562-13 12.800781-23.097657 28.300781-29.5 45.300781-6.300781 16.300781-10.699219 34.898438-11.898438 62.097657-1.300781 27.402343-1.601562 36.101562-1.601562 105.601562s.300781 78.199219 1.5 105.5c1.199219 27.199219 5.601562 45.898438 11.902343 62.101562 6.5 17.199219 16.597657 32.597657 29.597657 45.398438 12.800781 13 28.300781 23.101562 45.300781 29.5 16.300781 6.300781 34.898438 10.699219 62.101562 11.898438 27.296876 1.203124 36 1.5 105.5 1.5s78.199219-.296876 105.5-1.5c27.199219-1.199219 45.898438-5.597657 62.097657-11.898438 34.402343-13.300781 61.601562-40.5 74.902343-74.898438 6.296876-16.300781 10.699219-34.902343 11.898438-62.101562 1.199219-27.300781 1.5-36 1.5-105.5s-.101562-78.199219-1.300781-105.5zm-46.097657 209c-1.101562 25-5.300781 38.5-8.800781 47.5-8.601562 22.300781-26.300781 40-48.601562 48.601562-9 3.5-22.597657 7.699219-47.5 8.796876-27 1.203124-35.097657 1.5-103.398438 1.5s-76.5-.296876-103.402343-1.5c-25-1.097657-38.5-5.296876-47.5-8.796876-11.097657-4.101562-21.199219-10.601562-29.398438-19.101562-8.5-8.300781-15-18.300781-19.101562-29.398438-3.5-9-7.699219-22.601562-8.796876-47.5-1.203124-27-1.5-35.101562-1.5-103.402343s.296876-76.5 1.5-103.398438c1.097657-25 5.296876-38.5 8.796876-47.5 4.101562-11.101562 10.601562-21.199219 19.203124-29.402343 8.296876-8.5 18.296876-15 29.398438-19.097657 9-3.5 22.601562-7.699219 47.5-8.800781 27-1.199219 35.101562-1.5 103.398438-1.5 68.402343 0 76.5.300781 103.402343 1.5 25 1.101562 38.5 5.300781 47.5 8.800781 11.097657 4.097657 21.199219 10.597657 29.398438 19.097657 8.5 8.300781 15 18.300781 19.101562 29.402343 3.5 9 7.699219 22.597657 8.800781 47.5 1.199219 27 1.5 35.097657 1.5 103.398438s-.300781 76.300781-1.5 103.300781zm0 0"></path>
                  <path d="m256.449219 124.5c-72.597657 0-131.5 58.898438-131.5 131.5s58.902343 131.5 131.5 131.5c72.601562 0 131.5-58.898438 131.5-131.5s-58.898438-131.5-131.5-131.5zm0 216.800781c-47.097657 0-85.300781-38.199219-85.300781-85.300781s38.203124-85.300781 85.300781-85.300781c47.101562 0 85.300781 38.199219 85.300781 85.300781s-38.199219 85.300781-85.300781 85.300781zm0 0"></path>
                  <path d="m423.851562 119.300781c0 16.953125-13.746093 30.699219-30.703124 30.699219-16.953126 0-30.699219-13.746094-30.699219-30.699219 0-16.957031 13.746093-30.699219 30.699219-30.699219 16.957031 0 30.703124 13.742188 30.703124 30.699219zm0 0"></path>
                </svg></div>
            </a>
            <?php endif; ?>        
            
          </div>
        </div>
        <div class="footer-row">
          <div class="footer-left">
            
          <?php if(get_field('la_marque','options')): ?> 
          <a href="<?php the_field('lien_page_marque','options'); ?>" class="footer-item">
              <div class="icon-nav w-embed">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="white">
                  <g id="icon/brand" stroke="none" stroke-width="1">
                    <path d="M25.0086097,0 C35.9545552,0 46.8988693,1.53937048 50,4.62137358 L50,4.62137358 L50,18.2904905 C50,25.8791484 47.3683257,33.001863 42.2160877,39.4581938 C38.0324886,44.6799835 29.3310519,50 24.9747146,50 C20.5699816,50 11.8669137,44.6779899 7.72010977,39.4417018 C2.54013942,33.0883099 0,25.9723008 0,18.2904905 L0,18.2904905 L0,4.62137358 C3.0989556,1.54154524 14.0545077,0 25.0086097,0 Z M25.0068878,4 C16.2436061,4 7.47916448,5.23323619 5,7.69709886 L5,19.6323924 C5,25.7778406 7.03211154,31.4706479 11.1760878,36.5533615 C14.4935309,40.742392 21.4559853,45 24.9797717,45 C28.4648415,45 35.4259908,40.7439868 38.7728701,36.566555 C42.8946605,31.4014904 45,25.7033187 45,19.6323924 L45,7.69709886 C42.5190955,5.23149638 33.7636441,4 25.0068878,4 Z" id="Combined-Shape"></path>
                  </g>
                </svg>
              </div>
              <div class="text-block"><?php _e('La marque', 'guard-industrie') ?></div>
            </a>
          <?php endif; ?>  
            
              <?php if(get_field('nos_references','options')): ?> 
              <a href="<?php the_field('lien_page_references','options'); ?>"  class="footer-item w-inline-block">
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
              <div><?php _e('Références', 'guard-industrie') ?></div>
            </a>
          <?php endif; ?>      
      
          <?php if(get_field('contactez-nous','options')): ?>       
          <a href="<?php the_field('lien_page_contact','options'); ?>" class="footer-item">
              <div class="icon-nav w-embed">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="white">
                  <g id="icon/question" stroke="none" stroke-width="1">
                    <path d="M1.25,50 C0.9235,50 0.604,49.872 0.366,49.634 C0.03,49.298 -0.0865,48.801 0.065,48.351 L3.5875,37.899 C1.239,34.007 -0.000371523443,29.561 -0.000371523443,25 C-0.000371523443,11.215 11.215,0 25,0 C38.785,0 50,11.215 50,25 C50,38.785 38.785,50 25,50 C20.4395,50 15.993,48.761 12.1015,46.412 L1.649,49.9345 C1.5185,49.9785 1.384,50 1.25,50 Z M13.1093333,42.5368667 C13.3286667,42.5368667 13.5466,42.5989333 13.7360667,42.7198 C17.1054,44.8655333 21.0002,46 25,46 C36.5794,46 46,36.5794 46,25 C46,13.4206 36.5794,4 25,4 C13.4206,4 4,13.4206 4,25 C4,28.9998 5.13446667,32.8950667 7.28066667,36.2634667 C7.47013333,36.5616667 7.51493333,36.9289333 7.40246667,37.2635333 L4.6902,45.3098 L12.7369333,42.598 C12.8582667,42.5569333 12.9838,42.5368667 13.1093333,42.5368667 Z" id="Shape"></path>
                  </g>
                </svg>
              </div>
              <div><?php _e('Contactez-nous', 'guard-industrie') ?></div>
            </a>
          <?php endif; ?>   
                   
          </div>
          <div class="footer-right">
            
          <?php
             if ( has_nav_menu( 'footer-menu' ) ) : 
             wp_nav_menu ( array (
             'theme_location' => 'footer-menu' ,
             'menu_class' => 'footer-right', 
             ) ); 
             endif;?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="numero_vert" href="tel:0800 009 250"><span>0800 009 250</span></a>
  <script type="text/javascript">
  const radioButtonField = document.querySelectorAll(".radio-button-field input[name='listIDs[]']");
  window.dataLayer.push(
    {"event": "datalayer-loaded"}
  );
  
  let newsletterSuccessObject = {
    "event": "newsletter-success"
  }

  for(let i = 0; i < radioButtonField.length; i++) {
    radioButtonField[i].addEventListener('click', (e) => {
    newsletterSuccessObject.typologie_client = e.target.value;
    });
  }
  
  document.querySelector('form#sib_signup_form_2.sib_signup_form').addEventListener('reset', () => {
    const $msgDisp = document.querySelector('.sib_msg_disp')
    if ($msgDisp.querySelector('.sib-alert-message-success')) {
       window.dataLayer.push( newsletterSuccessObject )
    } 
  })
  
  const url = window.location.pathname;
  const urlSplit = url.split("/");
  let dataLayerLoadedObject = window.dataLayer.filter(obj => {
    return obj.event === "datalayer-loaded";
  });

  <?php $status_code_first_digit = substr( strval(http_response_code()), 0, 1 ); ?>
  <?php if ( $status_code_first_digit == '4' || $status_code_first_digit == '5' ): ?>
    dataLayerLoadedObject[0].pageType = 'error';
    console.log(dataLayerLoadedObject[0].pageType);
  <?php else: ?>
  
  switch(urlSplit[1]) {
    case "":
    case "pros":
    case "prescripteurs":
    case "industriels":
      dataLayerLoadedObject[0].pageType = 'home';
      dataLayerLoadedObject[0].page_cat1 = 'home';
      break;
    case "checkout":
      dataLayerLoadedObject[0].pageType = 'checkout';
      
      dataLayerLoadedObject[0].page_cat1 = urlSplit[2];
      break;
    case "produits-particuliers":
    case "produits-pros":
    case "produits-prescripteurs":
    case "produits-industriels":
      dataLayerLoadedObject[0].pageType = 'content';
      
      dataLayerLoadedObject[0].page_cat1 = urlSplit[1];
      dataLayerLoadedObject[0].page_cat2 = urlSplit[2];
      break;
    case "produits":
      dataLayerLoadedObject[0].pageType = 'product';
      dataLayerLoadedObject[0].page_cat1 = urlSplit[2];
      break;
    default:
      dataLayerLoadedObject[0].pageType = 'other';
      break;
  }
  
  <?php endif; ?>
  </script>