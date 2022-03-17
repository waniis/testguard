          <div class="sub-nav-right">
            
                <?php if(get_field('recherche','options')): ?>
            <div class="picto-item">
              <div class="search">
                <div class="w-embed">
                  <!--?xml version="1.0" encoding="UTF-8"?-->
                  <svg fill="#003a80" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                      <path d="M5.03980654,21.0413852 C5.03980654,12.2253485 12.1975861,5.05160807 20.9972935,5.05160807 C29.7960508,5.05160807 36.9547805,12.2253485 36.9547805,21.0413852 C36.9547805,29.858374 29.7960508,37.0311623 20.9972935,37.0311623 C12.1975861,37.0311623 5.03980654,29.858374 5.03980654,21.0413852 Z M37.5011396,34.0331386 C40.4429271,30.2810867 41.9955372,25.7959519 41.9955372,21.0394811 C41.9955372,9.43868119 32.576306,0 20.9972935,0 C9.41923118,0 0,9.43868119 0,21.0394811 C0,32.641233 9.41923118,42.0808663 20.9972935,42.0808663 C25.7444416,42.0808663 30.2217358,40.5242551 33.9673839,37.5766903 L45.3469968,49.2764376 C45.8116396,49.7429449 46.4501672,50 47.1438057,50 C47.8374442,50 48.4759717,49.7429449 48.9406145,49.2764376 C49.9487659,48.2663064 49.9487659,46.6839897 48.9387142,45.6729064 L37.5011396,34.0331386 Z" id="path-1"></path>
                    </defs>
                    <g id="icon/search" stroke="none" stroke-width="1">
                      <mask id="mask-2" fill="white">
                        <use xlink:href="#path-1"></use>
                      </mask>
                      <use id="icon" xlink:href="#path-1"></use>
                    </g>
                  </svg>
                </div>
              </div>
            </div>
            
               <?php endif; ?> 

            
            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="picto-item w-inline-block">
              <div class="account">
                <div class="w-embed">
                
                  <!--?xml version="1.0" encoding="UTF-8"?-->
                  <svg fill="#003a80" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="icon/profil" stroke="none" stroke-width="1">
                      <path d="M25,28.0779221 C31.1688312,28.0779221 36.1688312,23.0779221 36.1688312,16.9090909 L36.1688312,12.1688312 C36.1688312,6 31.1688312,1 25,1 C18.8311688,1 13.8311688,6 13.8311688,12.1688312 L13.8311688,16.9090909 C13.8311688,23.012987 18.8311688,28.0779221 25,28.0779221 Z M34.7402597,31.0649351 C43.1818182,31.0649351 50,37.8831169 50,46.3246753 C50,47.7532468 49.4419992,48.9220779 48.0134277,48.9220779 C46.5848563,48.9220779 45.8051948,47.7532468 45.8051948,46.3246753 C45.8051948,40.8051948 40.2597403,35.2597403 34.7402597,35.2597403 L34.7402597,35.2597403 L15.2597403,35.2597403 C9.74025974,35.2597403 4.19480519,40.8051948 4.19480519,46.3246753 C4.19480519,47.7532468 3.48325893,48.9220779 2.0546875,48.9220779 C0.626116071,48.9220779 0,47.7532468 0,46.3246753 C0,37.8831169 6.81818182,31.0649351 15.2597403,31.0649351 L15.2597403,31.0649351 Z M25,5.47402597 C28.8804348,5.47402597 32,8.3456213 32,11.9176057 L32,17.0304462 C32,20.6024306 28.8804348,23.474026 25,23.474026 C21.1195652,23.474026 18,20.6024306 18,17.0304462 L18,11.9176057 C18,8.3456213 21.1195652,5.47402597 25,5.47402597 Z" id="Shape"></path>
                    </g>
                  </svg>
                  

                </div>
              </div>
            </a>
            
            
            
            <div class="card-container">
              <div data-node-type="commerce-cart-wrapper" data-open-product="" data-wf-cart-type="rightSidebar" data-wf-cart-query="" data-wf-page-link-href-prefix="" class="w-commerce-commercecartwrapper cart" udy-el="wc-mini-cart">
                <a href="#" data-node-type="commerce-cart-open-link" class="w-commerce-commercecartopenlink cart-button w-inline-block">
                  <img src="<?php echo home_url(); ?>/wp-content/assets/img/shopping-cart2.svg" width="20" alt="" class="image-37">
                  <?php if(WC()->cart->get_cart_contents_count()>0): ?><div class="w-commerce-commercecartopenlinkcount cart-quantity" udy-el="wc-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div><?php endif; ?>
                </a>
                <div data-node-type="commerce-cart-container-wrapper" style="display:none" class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-rightSidebar cart-wrap">
                  <div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer cart-container">
                    <div class="w-commerce-commercecartheader cart-header">
                      <span class="w-commerce-commercecartheading cart-heading"><?php _e('Votre Panier', 'guard-industrie') ?></span>
                      <a href="#" data-node-type="commerce-cart-close-link" class="w-commerce-commercecartcloselink close-button w-inline-block"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/CloseCart2x_1CloseCart2x.png?v=1615988947611" width="11" alt="" class="cart-close-icon"></a>
                    </div>
                    <div class="w-commerce-commercecartformwrapper">
                      <?php $cart_items = udesly_woocommerce_get_cart_items(); ?><form data-node-type="commerce-cart-form" class="w-commerce-commercecartform default-state-2" style="<?php echo count($cart_items) > 0 ? "" : "display: none"; ?>">
                        
                        
                        <ul role="list" class="mini-cart-list" udy-el="wc-items-list">
                          <?php foreach( $cart_items as $item ) : ?><li class="cart-item-2">
                            <div class="mini-cart-row">
                              <div class="variations-main-wrapper">
                                <a href="<?php echo $item->remove; ?>" class="minicart-remove w-inline-block" data-cart-item-key="<?php echo $item->key; ?>" udy-el="wc-remove"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close.svg?v=1615988947611" loading="lazy" alt="" class="image-38"></a><img src="<?php echo $item->image; ?>" alt="" class="image-36">
                                <div class="minicart-info">
                                  <div class="text-block-38"><?php echo $item->title; ?></div>
                                  <div class="div-block-306">
                                    
                                    <?php if(get_field('active_discount','options')){ ?>
                                    <div class="minicart-price sales"><?php echo $item->price;?><?php echo apply_discount($item->price,.85);?></div>
                                    <?php }else{ ?>
                                        <div class="minicart-price "><?php echo $item->price;?></div>                                
                                    <?php } ?>
                                    
                                  </div>
                                </div>
                              </div>
                              <div class="cart-quantity-3"><?php echo $item->quantity; ?></div>
                            </div>
                          </li><?php endforeach; ?>
                        </ul>
                        <div class="mini-car-bottom-container">
                          <div class="cart-btn-container">
                            <a href="<?php echo wc_get_cart_url() ?>" class="btn-arrow-border-white w-inline-block">
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
                              <div class="btn-text">Modifier mon Panier</div>
                            </a>
                          </div>
                          <div class="w-commerce-commercecartfooter cart-footer" udy-el="wc-cart-actions">
                            <div class="w-commerce-commercecartlineitem cart-line-item">
                              <div class="size5-text"><?php _e('TOTAL', 'guard-industrie') ?></div>
                              <div class="w-commerce-commercecartordervalue size6-text" udy-el="wc-cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
                            </div>
                            <div>
                              <div data-node-type="commerce-cart-quick-checkout-actions" class="web-payments-2">
                                <a data-node-type="commerce-cart-apple-pay-button" style="background-image:-webkit-named-image(apple-pay-logo-white);background-size:100% 50%;background-position:50% 50%;background-repeat:no-repeat" class="w-commerce-commercecartapplepaybutton web-payment-button">
                                  <div></div>
                                </a>
                                <a data-node-type="commerce-cart-quick-checkout-button" style="display:none" class="w-commerce-commercecartquickcheckoutbutton"><svg class="w-commerce-commercequickcheckoutgoogleicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                                    <defs>
                                      <polygon id="google-mark-a" points="0 .329 3.494 .329 3.494 7.649 0 7.649"></polygon>
                                      <polygon id="google-mark-c" points=".894 0 13.169 0 13.169 6.443 .894 6.443"></polygon>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                      <path fill="#4285F4" d="M10.5967,12.0469 L10.5967,14.0649 L13.1167,14.0649 C14.6047,12.6759 15.4577,10.6209 15.4577,8.1779 C15.4577,7.6339 15.4137,7.0889 15.3257,6.5559 L7.8887,6.5559 L7.8887,9.6329 L12.1507,9.6329 C11.9767,10.6119 11.4147,11.4899 10.5967,12.0469"></path>
                                      <path fill="#34A853" d="M7.8887,16 C10.0137,16 11.8107,15.289 13.1147,14.067 C13.1147,14.066 13.1157,14.065 13.1167,14.064 L10.5967,12.047 C10.5877,12.053 10.5807,12.061 10.5727,12.067 C9.8607,12.556 8.9507,12.833 7.8887,12.833 C5.8577,12.833 4.1387,11.457 3.4937,9.605 L0.8747,9.605 L0.8747,11.648 C2.2197,14.319 4.9287,16 7.8887,16"></path>
                                      <g transform="translate(0 4)">
                                        <mask id="google-mark-b" fill="#fff">
                                          <use xlink:href="#google-mark-a"></use>
                                        </mask>
                                        <path fill="#FBBC04" d="M3.4639,5.5337 C3.1369,4.5477 3.1359,3.4727 3.4609,2.4757 L3.4639,2.4777 C3.4679,2.4657 3.4749,2.4547 3.4789,2.4427 L3.4939,0.3287 L0.8939,0.3287 C0.8799,0.3577 0.8599,0.3827 0.8459,0.4117 C-0.2821,2.6667 -0.2821,5.3337 0.8459,7.5887 L0.8459,7.5997 C0.8549,7.6167 0.8659,7.6317 0.8749,7.6487 L3.4939,5.6057 C3.4849,5.5807 3.4729,5.5587 3.4639,5.5337" mask="url(#google-mark-b)"></path>
                                      </g>
                                      <mask id="google-mark-d" fill="#fff">
                                        <use xlink:href="#google-mark-c"></use>
                                      </mask>
                                      <path fill="#EA4335" d="M0.894,4.3291 L3.478,6.4431 C4.113,4.5611 5.843,3.1671 7.889,3.1671 C9.018,3.1451 10.102,3.5781 10.912,4.3671 L13.169,2.0781 C11.733,0.7231 9.85,-0.0219 7.889,0.0001 C4.941,0.0001 2.245,1.6791 0.894,4.3291" mask="url(#google-mark-d)"></path>
                                    </g>
                                  </svg><svg class="w-commerce-commercequickcheckoutmicrosofticon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <g fill="none" fill-rule="evenodd">
                                      <polygon fill="#F05022" points="7 7 1 7 1 1 7 1"></polygon>
                                      <polygon fill="#7DB902" points="15 7 9 7 9 1 15 1"></polygon>
                                      <polygon fill="#00A4EE" points="7 15 1 15 1 9 7 9"></polygon>
                                      <polygon fill="#FFB700" points="15 15 9 15 9 9 15 9"></polygon>
                                    </g>
                                  </svg>
                                  <div><?php _e('Pay with browser.', 'guard-industrie') ?></div>
                                </a>
                              </div>
                              <div style="position:relative" data-wf-paypal-button="{&quot;layout&quot;:&quot;horizontal&quot;,&quot;color&quot;:&quot;black&quot;,&quot;shape&quot;:&quot;rect&quot;,&quot;label&quot;:&quot;paypal&quot;,&quot;tagline&quot;:false,&quot;note&quot;:false}" class="paypal">
                                <div style="position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;z-index:999;cursor:auto"></div>
                              </div>
                              <a href="<?php echo get_permalink( wc_get_page_id( 'checkout' ) ); ?>" value="VALIDER MES ACHATS" data-node-type="cart-checkout-button" class="w-commerce-commercecartcheckoutbutton main-button" data-loading-text="EN COURS ..."><?php _e('VALIDER MES ACHATS', 'guard-industrie') ?></a>
                            </div>
                          </div>
                        </div>
                     
                      </form>
                       
                      <div class="w-commerce-commercecartemptystate empty-state dark-cart-empty-state" udy-el="wc-no-items-in-cart" style="<?php echo count($cart_items) > 0 ? "display: none" : ""; ?>">
                        <div><?php _e('Vide', 'guard-industrie') ?></div>
                      </div>
                      <div style="display:none" data-node-type="commerce-cart-error" class="w-commerce-commercecarterrorstate error-message-2">
                        <div class="w-cart-error-msg" data-w-cart-quantity-error="Product is not available in this quantity." data-w-cart-checkout-error="Checkout is disabled on this site." data-w-cart-general-error="Something went wrong when adding this item to the cart." data-w-cart-cart_order_min-error="Cart failed."><?php _e('Product is not available in this quantity.', 'guard-industrie') ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              <script id="mini-cart-template">
          window.udeslyMiniCartTemplate = function(item) {
            return `<li class="cart-item-2">
                            <div class="mini-cart-row">
                              <div class="variations-main-wrapper">
                                <a href="${item.remove}" class="minicart-remove w-inline-block" data-cart-item-key="${item.key}" udy-el="wc-remove"><img src="images/close.svg" loading="lazy" alt="" class="image-38"></a><img src="${item.image}" alt="" class="image-36">
                                <div class="minicart-info">
                                  <div class="text-block-38">${item.title}</div>
                                  <div class="div-block-306">
                                    <div class="minicart-variation">1L</div>
                                    <div class="minicart-price">${item.price}</div>
                                  </div>
                                </div>
                              </div>
                              <div class="cart-quantity-3">${item.quantity}</div>
                            </div>
                          </li>`
          }
          </script></div>
            </div>
          </div>