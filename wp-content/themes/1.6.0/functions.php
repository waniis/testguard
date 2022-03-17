<?php
 defined( 'ABSPATH' ) || exit;

 if ( ! function_exists( 'udesly_setup' ) ) :

	function udesly_setup() {

		load_theme_textdomain( 'guard-industrie', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'udesly_setup' );

function udesly_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'udesly_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'udesly_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'udesly_customize_register' );

function udesly_customize_partial_blogname() {
	bloginfo( 'name' );
}

function udesly_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'udesly_theme_register_required_plugins' );

function udesly_theme_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'Udesly Adapter',
			'slug'      => 'udesly-adapter-plugin',
			'source'    => 'https://github.com/eclipsesrl/udesly-adapter-plugin/archive/master.zip',
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',    
		'has_notices'  => true,                    
		'dismissable'  => false,                   
		'dismiss_msg'  => '',                      
		'is_automatic' => true,                   
		'message'      => '',                     
	);

	tgmpa( $plugins, $config );
}

add_action( 'wp_enqueue_scripts', 'udesly_theme_enqueue_styles' );
function udesly_theme_enqueue_styles() {
    wp_enqueue_style( 'udesly-theme', get_stylesheet_directory_uri() .'/style.css' );
}

if (!defined('UDESLY_ENABLE_FRONTEND_EDITOR')) {
  define('UDESLY_ENABLE_FRONTEND_EDITOR', false);
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////.       DISKO CUSTOM         .///////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_current_page_ID(){
        global $post, $wp_query;
        
        if(!is_null($wp_query) && isset($wp_query->post) && isset($wp_query->post->ID) && !empty($wp_query->post->ID))
            return $wp_query->post->ID;
        else if(function_exists('get_the_id') && !empty(get_the_id()))
            return get_the_id();
        else if(!is_null($post) && isset($post->ID) && !empty($post->ID))
            return $post->ID;
        else if('page' == get_option( 'show_on_front' ) && !empty(get_option( 'page_for_posts' )))
            return get_option( 'page_for_posts' );
        else if((is_home() || is_front_page()) && !empty(get_queried_object_id()))
            return get_queried_object_id();
        else if($this->get('action') == 'edit' && isset($_GET['post']) && !empty($_GET['post']))
            return absint($_GET['post']);
        else if(!is_admin() && isset($_GET['p']) && !empty($_GET['p']))
            return absint($_GET['p']);
        
        return false;
    }


function get_u_slug(){

  if(!is_admin()){
      $univers=get_the_terms(get_current_page_ID(),'univers');
    
    if ($univers[0]){
    return $u_slug=$univers[0]->slug;
    }
  }else{
    return "particuliers";
  }
}

//menu
function register_my_menus() {
 register_nav_menus(
 array(
 'menu-particulier' => __( 'Menu particulier' ),
 'menu-pro' => __( 'Menu professionnel' ),
 'menu-prescripteurs' => __( 'Menu prescripteurs' ),
 'menu-industriels' => __( 'Menu industriels' ),
 'menu-marque' => __( 'Menu marque' ),
 'menu-reference' => __( 'Menu reference' ),
 'menu-ressource_particuliers' => __( 'Menu ressource particuliers' ),
 'menu-ressource_pro' => __( 'Menu ressource pro du bâtiment' ),
 'menu-ressource_prescripteurs' => __( 'Menu ressource prescripteurs' ),
 'menu-ressource_industriels' => __( 'Menu ressource industriels' ),
 'menu-expertise_prescripteurs' => __( 'Menu expertise prescripteurs' ),
 'menu-projets' => __( 'Menu créer un projet' ),
 'footer-menu' => __( 'Menu Footer' ),
 'language-menu' => __( 'Menu Langues' ),
 )
 );
}
add_action( 'init', 'register_my_menus' );

//options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title'    => 'Theme Options',
		'menu_title'    => 'Theme Options',
		'menu_slug'     => 'options-generales',
		'capability'    => 'edit_posts',
		'redirect'      => true
	));
	
	acf_add_options_sub_page(array(
		'page_title'    => 'E-commerce',
		'menu_title'    => 'E-commerce',
		'parent_slug'   => 'options-generales',
	));
	
		acf_add_options_sub_page(array(
		'page_title'    => 'Bandeau promo',
		'menu_title'    => 'Bandeau promo',
		'parent_slug'   => 'options-generales',
	));
	
	
		acf_add_options_sub_page(array(
		'page_title'    => 'Distributeurs',
		'menu_title'    => 'Distributeurs',
		'parent_slug'   => 'options-generales',
	));
	
		acf_add_options_sub_page(array(
		'page_title'    => 'Références',
		'menu_title'    => 'Références',
		'parent_slug'   => 'options-generales',
	));
	
	acf_add_options_sub_page(array(
		'page_title'    => 'Navigation',
		'menu_title'    => 'Navigation',
		'parent_slug'   => 'options-generales',
	));
	
	acf_add_options_sub_page(array(
		'page_title'    => 'Footer',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'options-generales',
	));
}


// ajout css et js custom
function add_assets() {
	
	//css
	wp_enqueue_style( 'normalize-css', get_stylesheet_directory_uri() . "/css/normalize.css", array(), NULL, NULL);
	wp_enqueue_style( 'webflow-css', get_stylesheet_directory_uri() . "/css/webflow.css", array(), NULL, NULL);
	wp_enqueue_style( 'guard-industrie.webflow-css', get_stylesheet_directory_uri() . "/css/guard-industrie.webflow.css", array(), NULL, NULL);
	wp_enqueue_style( 'global-css', get_stylesheet_directory_uri() . "/assets/css/global.css", array(), NULL, NULL);
	
	
	wp_enqueue_style( 'swiper-css', "https://unpkg.com/swiper/swiper-bundle.min.css", array(), NULL, NULL);
	//wp_enqueue_style( 'quickfix-css', 'https://guard-industrie.disko.love/wp-content/assets/quickfix/style.css', array(), NULL, NULL);
	
	//js
	wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js',array(), false, true);	
	wp_enqueue_script( 'global',  get_stylesheet_directory_uri() .'/assets/js/global.js',array(), true, true);


	//Special
	
		if ( is_page_template( 'template-page-home-particuliers.php' ) ){
	      wp_enqueue_script( 'home-js',  get_stylesheet_directory_uri() .'/assets/js/home.js',array(), false, true);	
		}
		
		if ( is_page( 'consommation' ) || is_page( 'consommation-pro' ) ){
	      wp_enqueue_script( 'conso-js',  get_stylesheet_directory_uri() .'/assets/js/conso.js',array(), false, true);	
		}
		
		if ( is_page_template( 'template-page-produit-adapte.php' ) ){
	      wp_enqueue_script( 'adapted_product_js',  get_stylesheet_directory_uri() .'/assets/js/adapted_product.js',array(), false, true);	
		}
		

}
add_action('wp_enqueue_scripts','add_assets');



// Method 2: Setting. 
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyCxH4WHkrUHAjxT5jSlc3dNaab1sN9Y-MY');//AIzaSyCfLTKTtUS7ryiHcCveQxEzCv38W6Rgg2U
}
add_action('acf/init', 'my_acf_init');


/**
 * Modif texte bouton add to cart
 */

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
  
function woo_custom_single_add_to_cart_text() {
    return __( 'ACHETER', 'woocommerce' );
}

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +
  
function woo_custom_product_add_to_cart_text() {
    return __( 'ACHETER', 'woocommerce' );
}



function prefix_register_script( $scripts ) {

	$scripts[] = [
		'handle'  => 'adapted_product',
		'source'  => get_stylesheet_directory_uri() . '/assets/js/adapted_product.js',
		'version' => '5.7.1',
	];

	return $scripts;

}

add_filter( 'wp_grid_builder/frontend/register_scripts', 'prefix_register_script' );

/**
 * CUSTOM CARDS
 */


function prefix_register_block( $blocks ) {
	
	// 'my_block' corresponds to the block slug.
	
		//STORE LOCATOR
	$blocks['title®'] = [
		'name' => __( 'title®', 'text-domain' ),
		'render_callback' => 'title_R_render',
	];
	
	//STORE LOCATOR
	$blocks['logo_distrib'] = [
		'name' => __( 'Logo distributeur', 'text-domain' ),
		'render_callback' => 'logo_distrib_render',
	];
	
	//PRODUCT
	$blocks['prix_list'] = [
		'name' => __( 'Prix liste', 'text-domain' ),
		'render_callback' => 'price_render',
	];
	
	$blocks['discount_badge'] = [
		'name' => __( 'Badge Promo', 'text-domain' ),
		'render_callback' => 'discount_render',
	];
	
	$blocks['btn-buy'] = [
		'name' => __( 'Bouton Acheter', 'text-domain' ),
		'render_callback' => 'btn_buy_render',
	];
	
	$blocks['btn-buy-pro'] = [
		'name' => __( 'Bouton Produit Découvrir', 'text-domain' ),
		'render_callback' => 'btn_buy_pro_render',
	];
	
	//REFERENCE
	$blocks['btn-reference'] = [
		'name' => __( 'Bouton Découvrir', 'text-domain' ),
		'render_callback' => 'btn_reference_render',
	];
	$blocks['bg-reference'] = [
		'name' => __( 'img reference BG', 'text-domain' ),
		'render_callback' => 'bg_reference_render',
	];
	
	//CONSEIL
	$blocks['btn-advice'] = [
    	'name' => __( 'Bouton En savoir plus', 'text-domain' ),
    	'render_callback' => 'btn_advice_render',
	];
	$blocks['bg-advice'] = [
		'name' => __( 'img advice BG', 'text-domain' ),
		'render_callback' => 'bg_advice_render',
	];
	
	//VIDEO
	$blocks['btn-video'] = [
    	'name' => __( 'Bouton Voir la video', 'text-domain' ),
    	'render_callback' => 'btn_video_render',
	];
	$blocks['bg-video'] = [
		'name' => __( 'img video BG', 'text-domain' ),
		'render_callback' => 'bg_video_render',
	];
	
	//CATALOG
	$blocks['btn-catalog'] = [
    	'name' => __( 'bouton catalogue', 'text-domain' ),
    	'render_callback' => 'btn_catalog_render',
	];
	//COMMERCIALS
    $blocks['commercial_card'] = [
    	'name' => __( 'Carte Commercial', 'text-domain' ),
    	'render_callback' => 'commercial_card_render',
    ];
	
	//DOWNLOAD
	$blocks['download_card'] = [
		'name' => __( 'Carte telechargement', 'text-domain' ),
		'render_callback' => 'card_download_render',
	];
	
	//DOWNLOAD SPECIFIC
	$blocks['download_card_specific'] = [
		'name' => __( 'Carte telechargement spécifique', 'text-domain' ),
		'render_callback' => 'card_download_specific_render',
	];

	return $blocks;
	
}

add_filter( 'wp_grid_builder/blocks', 'prefix_register_block', 10, 1 );

// The render callback function allows to output content in cards.
//STORE LOCATOR
function logo_distrib_render() {

	$post = wpgb_get_post();
	$id=$post->ID;
	
	$cat=get_the_terms($id,'distributor_logo');
	if($cat){
	$term_id=$cat[0]->term_id;
	
	$meta=get_term_meta($term_id);

  	if(array_key_exists('_featured_image',$meta)){
  	$image_id=$meta["_featured_image"][0];
  	
      $post_thumbnail_img = wp_get_attachment_image_src($image_id,'full');
  
      echo '<div class="distrib-card-img"><img src="' . $post_thumbnail_img[0] .'"/></div>';
    }
	}
  
  echo '<div class="distrib-card-content">';
  echo '<span class="distrib-title">'.get_the_title($id).'</span>';
  echo "<br/>";
  the_field('distributor_address',$id);
  echo "<br/>";
  the_field('distributor_zipcode',$id); 
  echo " ";
  the_field('distributor_city',$id);  
  echo "<br/>";
  the_field('distributor_phone',$id);  
  echo'</div>';
	

}

//PRODUCT
function price_render() {

	$post = wpgb_get_post();
	$product=$post->product;
	
    $rules=(wctd_get_product_applied_rule( $post->ID) );

if(!is_admin()) {
    if(get_u_slug()=="particuliers"){
    	
      	if(array_key_exists('variation_price',$product)){
      	    
      	    $product_id = wc_get_product($post->ID);
      	    $variations = $product_id->get_children();
      	    $min_sale_price = wc_price( wc_get_price_including_tax( wc_get_product($variations[0]), array('price' => wc_get_product($variations[0])->get_regular_price() ) ));
      		$min_price = $product->variation_price['min'];
    
      	    $price = sprintf( __( 'À partir de %1$s', 'woocommerce' ),  $min_price );
      	    echo $price;
      	    
      	    if ( $product_id->is_on_sale() )  {    
                echo '  <span class="product-price-promo" >'.$min_sale_price.'</span>';
            }
      	
      	} else {
            $product_id = wc_get_product($post->ID);
    
            $price = (100-$rules["value"])/100*$product_id->get_regular_price();
            
            echo wc_price( wc_get_price_including_tax( $product_id, array('price' => $price )));
            
             if ( $product_id->is_on_sale() )  {    
                echo '  <span class="product-price-promo" >'.wc_price( wc_get_price_including_tax( $product_id, array('price' => $product_id->get_regular_price() ))).'</span>';
             }
      	}
    	
    }
}
  
}


function discount_render() {

	$post = wpgb_get_post();
	$product=$post->product;
	
    $rules=(wctd_get_product_applied_rule( $post->ID) );

    if(!is_admin()) {
        if(get_u_slug()=="particuliers"){
        	$product_id = wc_get_product($post->ID);
          	if(array_key_exists('variation_price',$product)){
          	    if ( $product_id->is_on_sale() )  {    
                    echo '<div class="sale-badge" ><span class="inner-badge">-'.$rules["value"].'%</span></div>';
                }
                
          	
          	} else {
          	    
                 if ( $product_id->is_on_sale() )  {    
                    echo '<div class="sale-badge" ><span class="inner-badge">-'.$rules["value"].'%</span></div>';
                 }
          	}
        	
        }
    }
  
}

function addGTMInHead() {
echo "<script>window.dataLayer = window.dataLayer || [];</script>";
echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TKNWQDN');</script>
<!-- End Google Tag Manager -->";
}
add_action( 'wp_head', 'addGTMInHead' );

function addGTMMasterTagBodyInBody() {
    echo '<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKNWQDN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->';
}
add_action( 'wp_body_open', 'addGTMMasterTagBodyInBody' );


function apply_discount($price,$discount){
  
  $price=str_replace(",",".", $price);
  $sale_price=floatval( preg_replace( '#[^\d.]#', '',$price))*$discount; 
  $new_price=wc_price($sale_price);
  
  if(get_field('active_discount','options')){
    return $new_price;
  }else{
    return $price;
  }
}

function btn_buy_render() {

	$post = wpgb_get_post();
	
	echo '
		<div class="card-btn-buy">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1">
				    <g id="icon/shop" stroke="none" stroke-width="1">
				        <path d="M19.7777778,10.7777778 L10.6666667,10.7777778 L10.6666667,6.59759521 L19.7777778,6.59759521 L19.7777778,10.7777778 Z M41.2551931,5.82233181 L37.0568848,6.42553711 L34.7335514,8.74887044 C34.5402181,8.554426 33.6122222,7.77777778 33.0011111,7.77777778 C32.39,7.77777778 27.4444444,7.77777778 27.4444444,7.77777778 C27.4444444,7.77777778 27.4444444,6.02777778 27.4444444,3.88888889 C27.4444444,1.75 25.4444444,0 23,0 L7.44444444,0 C5,0 3,2 3,4.44444444 L3,45.5555556 C3,48 5,50 7.44444444,50 L40.7777778,50 C43.2222222,50 45.2222222,48 45.2222222,45.5555556 L45.2222222,23.3333333 C45.2222222,20.8888889 45.2222222,20.61 45.2222222,19.9988889 C45.2222222,19.3877778 44.3071463,17.9197428 44.1138129,17.7275206 L46.4360352,15.4030762 L46.934082,11.5012207 L41.2551931,5.82233181 Z M41.1111111,43.9512195 C41.1111111,45.0821463 40.2151111,46 39.1111111,46 L9.11111111,46 C8.00811111,46 7.11111111,45.0821463 7.11111111,43.9512195 L7.11111111,6.04878049 C7.11111111,4.91887805 8.00811111,4 9.11111111,4 L21.1111111,4 C22.1761111,4 23.1111111,4.71809756 23.1111111,5.53658537 C23.1111111,5.83365854 23.1111111,11.1707317 23.1111111,11.1707317 L32.6121111,11.1707317 L41.1111111,19.8770244 L41.1111111,43.9512195 Z M43.4532444,13.6641873 L41.7143555,15.4030762 C40.1721332,13.8608539 38.599107,12.3211111 37.0568848,10.7777778 L39.1111111,8.875 L44.1138129,13.2458496 L43.4532444,13.6641873 Z" id="Shape"/>
				    </g>
				</svg>
			<span class="btn-buy-label"> ACHETER </span>
		</div>';
	
}

function btn_buy_pro_render() {

	$post = wpgb_get_post();

	  	echo '
		<div class="card-btn-buy">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1">
				    <g id="icon/shop" stroke="none" stroke-width="1">
				        <path d="M19.7777778,10.7777778 L10.6666667,10.7777778 L10.6666667,6.59759521 L19.7777778,6.59759521 L19.7777778,10.7777778 Z M41.2551931,5.82233181 L37.0568848,6.42553711 L34.7335514,8.74887044 C34.5402181,8.554426 33.6122222,7.77777778 33.0011111,7.77777778 C32.39,7.77777778 27.4444444,7.77777778 27.4444444,7.77777778 C27.4444444,7.77777778 27.4444444,6.02777778 27.4444444,3.88888889 C27.4444444,1.75 25.4444444,0 23,0 L7.44444444,0 C5,0 3,2 3,4.44444444 L3,45.5555556 C3,48 5,50 7.44444444,50 L40.7777778,50 C43.2222222,50 45.2222222,48 45.2222222,45.5555556 L45.2222222,23.3333333 C45.2222222,20.8888889 45.2222222,20.61 45.2222222,19.9988889 C45.2222222,19.3877778 44.3071463,17.9197428 44.1138129,17.7275206 L46.4360352,15.4030762 L46.934082,11.5012207 L41.2551931,5.82233181 Z M41.1111111,43.9512195 C41.1111111,45.0821463 40.2151111,46 39.1111111,46 L9.11111111,46 C8.00811111,46 7.11111111,45.0821463 7.11111111,43.9512195 L7.11111111,6.04878049 C7.11111111,4.91887805 8.00811111,4 9.11111111,4 L21.1111111,4 C22.1761111,4 23.1111111,4.71809756 23.1111111,5.53658537 C23.1111111,5.83365854 23.1111111,11.1707317 23.1111111,11.1707317 L32.6121111,11.1707317 L41.1111111,19.8770244 L41.1111111,43.9512195 Z M43.4532444,13.6641873 L41.7143555,15.4030762 C40.1721332,13.8608539 38.599107,12.3211111 37.0568848,10.7777778 L39.1111111,8.875 L44.1138129,13.2458496 L43.4532444,13.6641873 Z" id="Shape"/>
				    </g>
				</svg>
			<span class="btn-buy-label">Découvrir</span>
		</div>';
	
}

function commercial_card_render() {
  $post = wpgb_get_post();
  $id = $post->ID;
  
 echo '<div class="com-card-top">';
        if(get_field('commercial_img',$id)) {
        echo '<div class="com-card-img-container"><img class="com-card-img" src="' . get_field('commercial_img',$id) . '" loading="lazy" alt=""/></div>';
        }
        echo '<div class="com-card-name">';
        echo get_the_title($id);
        echo '</div>';
        echo '<div class="com-card-function">'. get_the_content(null, false, $id) .'</div></div>';
        echo '
      <div class="com-card-content">
        <a href="tel:' . get_field('commercial_phone',$id) . '" class="com-card-phone">';
          the_field('commercial_phone',$id);
    echo'</a>
        <a href="mailto:'. get_field('commercial_email',$id).'"class="com-card-email">';
          the_field('commercial_email',$id);
    echo'</a>';
    
    if(get_field('commercial_linkedin',$id)) {
	    echo'<a href="'. get_field('commercial_linkedin', $id) .'" target="_blank"class="com-card-likedin w-inline-block">
	            <span class="social-picto w-embed"> <?xml version="1.0" encoding="UTF-8"?>
	                <svg viewbox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	                    <g id="icon/social/linkedin" stroke="none" stroke-width="1">
	                        <path d="M50,30.269802 L50,47.9059406 C50,48.3391089 49.6287129,48.710396 49.1955446,48.710396 L40.0990099,48.710396 C39.6658416,48.710396 39.2945545,48.3391089 39.2945545,47.9059406 L39.2945545,31.5074257 C39.2945545,27.1757426 37.7475248,24.2054455 33.8490099,24.2054455 C30.8787129,24.2054455 29.1460396,26.1856436 28.3415842,28.1039604 C28.0321782,28.7846535 27.970297,29.7747525 27.970297,30.7029703 L27.970297,47.9059406 C27.970297,48.3391089 27.5990099,48.710396 27.1658416,48.710396 L18.1311881,48.710396 C17.6980198,48.710396 17.3267327,48.3391089 17.3267327,47.9059406 C17.3267327,43.5123762 17.450495,22.2871287 17.3267327,17.3366337 C17.3267327,16.9034653 17.6980198,16.5321782 18.1311881,16.5321782 L27.2277228,16.5321782 C27.6608911,16.5321782 28.0321782,16.9034653 28.0321782,17.3366337 L28.0321782,21.1113861 C28.0321782,21.1732673 27.970297,21.1732673 27.970297,21.2351485 L28.0321782,21.2351485 L28.0321782,21.1113861 C29.4554455,18.9455446 31.9925743,15.789604 37.6856436,15.789604 C44.740099,15.789604 50,20.4306931 50,30.269802 L50,30.269802 Z M10.5816832,16.5321782 C11.0148515,16.5321782 11.3861386,16.9034653 11.3861386,17.3366337 L11.3861386,17.3366337 L11.3861386,47.9678218 C11.3861386,48.4009901 11.0148515,48.7722772 10.5816832,48.7722772 L10.5816832,48.7722772 L1.48514851,48.7722772 C1.0519802,48.7722772 0.742574257,48.4009901 0.680693069,47.9678218 L0.680693069,47.9678218 L0.680693069,17.3366337 C0.680693069,16.9034653 1.0519802,16.5321782 1.48514851,16.5321782 L1.48514851,16.5321782 Z M5.7549505,1 C8.93332189,1 11.509901,3.5765791 11.509901,6.7549505 C11.509901,9.93332189 8.93332189,12.509901 5.7549505,12.509901 C2.5765791,12.509901 0,9.93332189 0,6.7549505 C0,3.5765791 2.5765791,1 5.7549505,1 Z" id="XMLID_18_"></path>
	                    </g>
	                </svg>
	            </span>
	        </a>';
	    }
       echo '<div class="com-card-contact">
            <a href="mailto:';
            the_field('commercial_email',$id);
            echo '" class="link-arrow-white" data-trk-contact-commercial="Prendre contact - ' . get_the_title($id) . '">
                <div class="btn-arrow-picto w-embed"> <?xml version="1.0" encoding="UTF-8"?>
                    <svg viewbox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                <div class="btn-text">Prendre contact</div>
            </a>
        </div>
      </div>';
  
}

//TITLE R
function title_R_render() {
  $post = wpgb_get_post();
  special_title(get_the_title($post->ID));
}


//REFERENCE
function btn_reference_render() {

	$post = wpgb_get_post();
	
	echo '<div class="reference-related-btn-container">
                    <div class="link-arrow-white">
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
                      <div class="btn-text">decouvrir</div>
                    </div>
                  </div>';
}
function bg_reference_render() {

	$post = wpgb_get_post();

	echo '<img class="reference-card-bg" src="'.get_field('reference_gallery', $post->ID)[0]['url'].'"/>' ;
}

//ADVICE
function btn_advice_render() {

	$post = wpgb_get_post();
	
	echo '
        <div class="advice-card-btn-container">
        	<div class="link-arrow-blue">
        	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
        	    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                <div class="btn-text" style="color:#003a80">EN SAVOIR&nbsp;PLUS</div>
            </div>
    	</div>';
}
function bg_advice_render() {

	$post = wpgb_get_post();

	echo '<img class="advice-card-bg" src="'. get_the_post_thumbnail_url($post) .'"/>' ;
}

//VIDEO
function btn_video_render() {

	$post = wpgb_get_post();
	
	echo '
        <div class="advice-card-btn-container">
        	<div class="link-arrow-blue">
        	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
        	    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                <div class="btn-text" style="color:#003a80">Voir la video</div>
            </div>
    	</div>';
}
function bg_video_render() {

	$post = wpgb_get_post();

	echo '<img class="advice-card-bg" src="'. get_the_post_thumbnail_url($post) .'"/>' ;
}

//ADVICE
function btn_catalog_render() {

	$post = wpgb_get_post();
	echo '
	 <div class="advice-card-btn-container catalogue-btn">
        	<a href="'.get_the_permalink($post->ID).'" class="link-arrow-blue">
        	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
            	   <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                <div class="btn-text" style="color:#003a80">Voir le catalogue</div>
            </a>
    	</div>
        <div class="advice-card-btn-container catalogue-btn">
        	<a href="'.get_field('catalogue_file', $post->ID)['url'].'" download class="link-arrow-blue" data-trk-telechargement-catalogue="Télécharger - ' . $post->post_title . '">
        	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
            	  <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                <div class="btn-text" style="color:#003a80">Télécharger</div>
            </a>
    	</div>';
}

//DOWNLOAD
function card_download_render() {
  $post = wpgb_get_post();
  $id = $post->ID;
  $terms = get_the_terms( $id , 'gamme' );
  if ( !empty( $terms ) ){
      $term = array_shift( $terms );
  }
  
  echo  '<div class="download-card">';
  if ( !empty( $term ) ){
     echo  '<div class="download-gamme">'. $term->name .'</div>';
  }
      echo '<div class="download-name">'.get_the_title($id).'</div>
      <div class="download-list">';
       if( have_rows('product_informations',$id) ) {
         while ( have_rows('product_informations',$id) ) { 
           the_row();
           if( have_rows('product_documents',$id) ) {
             while ( have_rows('product_documents',$id) ) { 
               the_row();
               echo '
               <div class="download-item">
                  <div class="download-link">
                    <span class="download-link-name">'.get_sub_field('product_document_title').'</span>
                    <span class="download-btn-container">
                       <div class="advice-card-btn-container">
                          	<a class="link-arrow-blue" data-trk-telechargement-documents-techniques="Fiche technique - ' . $post->post_title .'" href="'.get_sub_field('product_document_file')['url'].'" download>
                          	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
                          	    <!--?xml version="1.0" encoding="UTF-8"?-->
                                      <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                                  <div class="btn-text" style="color:#003a80">télécharger</div>
                              </a>
                      	</div>
                    </span>
                  </div>
                </div>
               ';
             }
           }
         }
       };
    echo'  </div>
    </div>';
};
function card_download_specific_render() {
  $post = wpgb_get_post();
  $id = $post->ID;
  $terms = get_the_terms( $id , 'gamme' );
  if ( !empty( $terms ) ){
      $term = array_shift( $terms );
  }
  
  echo  '<div class="download-card">';
  if ( !empty( $term ) ){
     echo  '<div class="download-gamme">'. $term->name .'</div>';
  }
      echo '<div class="download-name">'.get_the_title($id).'</div>
      <div class="download-list">';
       if( have_rows('product_informations',$id) ) {
         while ( have_rows('product_informations',$id) ) { 
           the_row();
           if( have_rows('product_documents_specific',$id) ) {
             while ( have_rows('product_documents_specific',$id) ) { 
               the_row();
               echo '
               <div class="download-item">
                  <div class="download-link">
                    <span class="download-link-name">'.get_sub_field('product_document_specific_title').'</span>
                    <span class="download-btn-container">
                       <div class="advice-card-btn-container">
                          	<a class="link-arrow-blue" data-trk-telechargement-specifications-techniques="Spécifications techniques - ' . $post->post_title . '" href="'.get_sub_field('product_document_specific_file')['url'].'" download>
                          	    <div class="btn-arrow-picto w-embed" style="display: flex; margin-right: 10px;">
                          	    <!--?xml version="1.0" encoding="UTF-8"?-->
                                      <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill:#003a80">
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
                                  <div class="btn-text" style="color:#003a80">télécharger</div>
                              </a>
                      	</div>
                    </span>
                  </div>
                </div>
               ';
             }
           }
         }
       };
    echo'  </div>
    </div>';
};

/**
 * FUNCTIONS FILTERS / GRIDS
 */

//PRODUCTS
function filters_Products($grid) {
	//list grid == All ressources grids with only Gamme as filter check on WPGB Plugin for those ids
    $gridList = $grid == 41 || $grid == 43 || $grid == 44 || $grid == 45 || $grid == 46 || $grid == 47 || $grid == 48 || $grid == 49 || $grid == 50 || $grid == 51 || $grid == 52 || $grid == 53 || $grid == 54;
 if(get_u_slug()=="particuliers" && !($gridList)  || get_u_slug()=="pro-du-batiment" && !($gridList) ) {
	  if( $grid == 4 || $grid == 22 || $grid == 23 || $grid == 24 || $grid == 25 || $grid == 26 || $grid == 27  || $grid == 11) {
				echo '<div class="filter-block">
	            <div class="filter-title-trigger">
	              <div class="filter-title"> Gammes </div>
	            </div>
	            <div class="filter-container">';
	                wpgb_render_facet(
	                  	[
	                  		'id'   => 7,
	                  		'grid' => $grid,
	                  	]
	                  );
	            echo '</div>
	          </div>';	
		}
		
          if( !($grid == 22 || $grid == 23 || $grid == 24 || $grid == 25 || $grid == 26 || $grid == 27) ) {
          echo '<div class="filter-block">
            <div class="filter-title-trigger">
              <div class="filter-title"> Support </div>
            </div>
            <div class="filter-container">';
                wpgb_render_facet(
                  	[
                  		'id'   => 8,
                  		'grid' => $grid,
                  	]
                  );
            echo '</div>
          </div>';
          }
          
          echo '<div class="filter-block">
            <div class="filter-title-trigger">
              <div class="filter-title"> Materiaux </div>
            </div>
            <div class="filter-container">';
                wpgb_render_facet(
                  	[
                  		'id'   => 9,
                  		'grid' => $grid,
                  	]
                  );
            echo '</div>
          </div>';
          echo '<div class="filter-block">
            <div class="filter-title-trigger">
              <div class="filter-title"> Surface </div>
            </div>
            <div class="filter-container">';
                wpgb_render_facet(
                  	[
                  		'id'   => 10,
                  		'grid' => $grid,
                  	]
                  );
            echo '</div>
          </div>';
          echo '<div class="filter-block">
            <div class="filter-title-trigger">
              <div class="filter-title"> Propriétés </div>
            </div>
            <div class="filter-container">';
                wpgb_render_facet(
                  	[
                  		'id'   => 11,
                  		'grid' => $grid,
                  	]
                  );
            echo '</div>
          </div>';
          echo '<div class="filter-block">';
                wpgb_render_facet(
                  	[
                  		'id'   => 12,
                  		'grid' => $grid,
                  	]
                  );
          echo '</div>';
	}
	//put gamme filter
	elseif($gridList) {
				echo '<div class="filter-block">
	            <div class="filter-title-trigger">
	              <div class="filter-title"> Gammes </div>
	            </div>
	            <div class="filter-container">';
	                wpgb_render_facet(
	                  	[
	                  		'id'   => 7,
	                  		'grid' => $grid,
	                  	]
	                  );
	            echo '</div>
	          </div>';	
          echo '<div class="filter-block">';
                wpgb_render_facet(
                  	[
                  		'id'   => 12,
                  		'grid' => $grid,
                  	]
                  );
          echo '</div>';
		}
	//put property filter in case it don't match
	else {
	  	echo '<div class="filter-block">
	            <div class="filter-title-trigger">
	              <div class="filter-title"> Propriétés </div>
	            </div>
	            <div class="filter-container">';
	                wpgb_render_facet(
	                  	[
	                  		'id'   => 11,
	                  		'grid' => $grid,
	                  	]
	                  );
	            echo '</div>
	          </div>';	
           echo '<div class="filter-block">';
                wpgb_render_facet(
                  	[
                  		'id'   => 12,
                  		'grid' => $grid,
                  	]
                  );
          echo '</div>';
	}
};

//REFERENCES
function filters_Reference($grid) {
	if( !($grid == 13 || $grid == 28 || $grid == 29 || $grid == 30) ) {
		echo '<div class="filter-block">
        <div class="filter-title-trigger">
          <div class="filter-title"> Univers </div>
        </div>
        <div class="filter-container">';
            wpgb_render_facet(
              	[
              		'id'   => 16,
              		'grid' => $grid,
              	]
              );
    echo '</div>
	      </div>';
	}  
	
		echo '<div class="filter-block">
        <div class="filter-title-trigger">
          <div class="filter-title"> Gammes </div>
        </div>
        <div class="filter-container">';
            wpgb_render_facet(
              	[
              		'id'   => 7,
              		'grid' => $grid,
              	]
              );
    echo '</div>
      </div>';	
                    
// 		echo '<div class="filter-block">
//         <div class="filter-title-trigger">
//           <div class="filter-title"> Produits </div>
//         </div>
//         <div class="filter-container">';
//             wpgb_render_facet(
//               	[
//               		'id'   => 17,
//               		'grid' => $grid,
//               	]
//               );
//     echo '</div>
//       </div>';
          
    echo '<div class="filter-block">';
          wpgb_render_facet(
            	[
            		'id'   => 12,
            		'grid' => $grid,
            	]
            );
      echo '</div>';
};
//CONSEILS
function filters_Advice($grid) {
	
		echo '<div class="filter-block">
        <div class="filter-title-trigger">
          <div class="filter-title"> Univers </div>
        </div>
        <div class="filter-container">';
            wpgb_render_facet(
              	[
              		'id'   => 16,
              		'grid' => $grid,
              	]
              );
    echo '</div>
	      </div>';
          
		echo '<div class="filter-block">
        <div class="filter-title-trigger">
          <div class="filter-title"> Support </div>
        </div>
        <div class="filter-container">';
            wpgb_render_facet(
              	[
              		'id'   => 8,
              		'grid' => $grid,
              	]
              );
    echo '</div>
      </div>';	
                    
		echo '<div class="filter-block">
        <div class="filter-title-trigger">
          <div class="filter-title"> Materiaux </div>
        </div>
        <div class="filter-container">';
            wpgb_render_facet(
              	[
              		'id'   => 9,
              		'grid' => $grid,
              	]
              );
    echo '</div>
      </div>';
          
    echo '<div class="filter-block">';
          wpgb_render_facet(
            	[
            		'id'   => 12,
            		'grid' => $grid,
            	]
            );
      echo '</div>';
};
//GENERAL
function search_Facet($grid) {
	        wpgb_render_facet(
              	[
              		'id'   => 5,
              		'grid' => $grid,
              	]);
};
function gridRender($grid) {
	   wpgb_render_grid( $grid );
	   echo '<div class="pagination-container">';
      
              wpgb_render_facet(
              	[
              		'id'   => 14,
              		'grid' => $grid,
              	]);
              	
          echo '</div>';
};
function partners_List() {
    if(get_u_slug()=="particuliers"){
        if(is_front_page()){
          $partners=get_field('partenaires_all',"options");
        } else {
          $partners=get_field('partenaires_particuliers',"options");        
        }
          
      }
      
    if(get_u_slug()=="industriels"){
          $partners=get_field('partenaires_industriels',"options");    
      }
        if(get_u_slug()=="pro-du-batiment"){
          $partners=get_field('partenaires_pro',"options");    
      }

    foreach( $partners as $partner) {

      		echo '
      		<li class="partners-item">
            <a href="'.get_field('partners_link',$partner->ID).'" class="partners-link w-inline-block" target="_blank">
              <img src="'.get_the_post_thumbnail_url($partner->ID).'" loading="lazy" alt="" class="partners-img">
            </a>
          </li>
          ';
          
      	}
}
function bestsellerList($h3 = null) {
      if(get_u_slug()=="particuliers"){
          $bestsellers=get_field('option_best_seller',"options");
          $btn_label= 'Acheter';
      }else{
          $bestsellers=get_field('option_best_seller_pro',"options");   
          $btn_label= 'Découvrir'; 
      }

      	foreach( $bestsellers as $bestseller) {
      	   $product = new WC_Product($bestseller->ID);
      	   $terms = get_the_terms( $bestseller->ID, 'gamme' );
      	   $color;
      	   $gamme_name;
      	   if( $terms && ! is_wp_error( $terms ) ){
                        foreach( $terms as $term ){
                            $color = get_field( 'gamme_color', 'gamme_' . $term->term_id );
                            $gamme_name = $term->name;
                        }
                    }

      		echo '
      	    <a href="'. get_the_permalink($bestseller->ID)  .'" class="swiper-slide product-slide w-inline-block">
            <div class="product-card">
              <div class="img-container">
                
                <img class="img-title" '. rawww_image_srcset( get_field('product_logo_name', $bestseller->ID) ) . 'sizes="200px" alt="">
                
                <img '. rawww_image_srcset( "featured_image", $bestseller->ID ) .'" sizes="200px" alt="" class="img-product">
               
                <div class="color-dot" style="background-color:'.$color.'">
                  <div class="dot-cross-line"></div>
                  <div class="dot-cross-line vertical"></div>
                </div>
              </div>
            </div>
            <div class="product-hover" style="background-color:'.$color.'">
              <div class="product-function">'. $term->name .'</div>';
              
              if ($h3 == true) {
                echo '<h3 ';
              } else {
                echo '<div ';
              }
              echo 'class="product-name">';
              
              special_title(get_the_title($bestseller->ID));
              
              if ($h3) {
                echo '</h3>';
              } else {
                echo '</div>';
              }
              
              echo '
              <div class="product-short-description">'. $product->get_short_description() .'</div>
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
                  <div class="btn-text">'. $btn_label .'</div>
                </div>
              </div>
            </div>
          </a>';
      	}
}



/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
 
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
 
  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;
 
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );
 
  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;
 
  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
 
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );
 
    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );
 
    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }
 
    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }
 
 
    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);


//retire metabbox sur si callback false
add_filter( 'rest_prepare_taxonomy', function( $response, $taxonomy, $request ){
$context = ! empty( $request['context'] ) ? $request['context'] : 'view';

        // Context is edit in the editor
        if( $context === 'edit' && $taxonomy->meta_box_cb === false ){

            $data_response = $response->get_data();

            $data_response['visibility']['show_ui'] = false;

            $response->set_data( $data_response );
        }

        return $response;
}, 10, 3 );

//images dans emails transactionnels

function my_email_order_items_args( $args ) {
    $args['show_image'] = true;
return $args;
}
add_filter( 'woocommerce_email_order_items_args', 'my_email_order_items_args', 10, 1 );

add_filter('woocommerce_order_item_thumbnail', 'filter_item_thumb', 10, 2);
function filter_item_thumb($image, $item){

    $itemObject = $item->get_product();
    $image_url = get_the_post_thumbnail($itemObject->get_id(), 'thumbnail'); // use your image size
    // you can add_image_size() to specify your uncropped thumbnail

    return $image_url;
}

//get image by id term

function the_cat_img($id, $size){

  $meta=get_term_meta($id);

	if(array_key_exists('_featured_image',$meta)){
	$image_id=$meta["_featured_image"][0];
	}
	
	$image = wp_get_attachment_image_src($image_id, $size);
	
	echo $image[0];
}

//name status WC


// PLUS MINUS ON PRODUCTS
 
add_action( 'wp_footer', 'ts_quantity_plus_minus' );
 
function ts_quantity_plus_minus() {
   // To run this on the single product page
   if ( ! is_product() ) return;
   ?>
   <script type="text/javascript">
          
      jQuery(document).ready(function($){   
          
            $('.quantity-wrapper').on( 'click', '.quatity-btn-less, .quatity-btn-more', function() {
 
            // Get current quantity values
            var qty = $( this ).closest( '.quantity-wrapper' ).find( '.quantity-3' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
 
            // Change the value if plus or minus
            if ( $( this ).is( '.quatity-btn-more' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } 
            else {
               qty.val( val + step );
                 }
            } 
            else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } 
               else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
             
         });
          
      });
          
   </script>
   <?php
}

add_action('template_redirect', 'misha_redirect_to_orders_from_dashboard' );
 
function misha_redirect_to_orders_from_dashboard(){
 
	if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
		exit;
	}
 
}

function listing_class($slug){
  echo 'listing-product '.$slug;
}


function order_received_empty_cart_action(){
    WC()->cart->empty_cart();
}


function special_title($string){
  echo str_replace ('®','<sup>®</sup>',$string);
}

function calcul_conso($content){
  if(is_page('consommation')||is_page('consommation-pro')){
    
  $products=get_field('products');

  echo '<script type="text/javascript">var tempArray ='.json_encode($products).';</script>';
  return $content;

  }
  return $content;
  
}
add_filter( 'the_content', 'calcul_conso', 1 );



function wc_get_product_price_html( $product_id ) {
    return ( $product = wc_get_product( $product_id ) ) ? $product->get_price_html() : false;
}

















function guardindustrie_get_location_cookie_name() {
	return 'wp-guardindustrie_market_location';
}
function guardindustrie_get_location_cookie_value() {
	if ( guardindustrie_location_cookie_exists() ) {
		return $_COOKIE[ guardindustrie_get_location_cookie_name() ];
	} else {
        $country_code = geoip_detect2_get_info_from_current_ip()->country->isoCode;
        
        setcookie( guardindustrie_get_location_cookie_name(), $country_code, '', "/" ); // Session cookie, should disappear when browser closes
        
        return $country_code;
	}
}
function guardindustrie_location_cookie_exists() {
	return isset( $_COOKIE[ guardindustrie_get_location_cookie_name() ] );
}



// For earlier versions of PHP, polyfill of the str_contains function:
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}



/** function get_breadcrumb_data
 * Build an array of data, to be used to build both JSON-LD breadcrumbs and DOM breadcrumbs
 * 
 * @return array       An array of subarrays, each containing a page label and (except for the last one) its URL
 */ 
function get_breadcrumb_data() {
    global $post;
    $array = [];
    
    // Show homepage in the breadcrumb
    $array[] = [
        'label' => 'Accueil',
        'url' => get_home_url() 
    ];
    
    if (!$post) {
        // error_log( 'houston, $post is null (in 1.5.0/functions.php on line 1583)' );
        return null;
    }
    
    // Show the universe in the breadcrumb 
    $terms = get_the_terms( $post->ID, 'univers' );
    if ( !empty( $terms ) ) {
        $univers = array_shift( $terms );
        
        if ( 'Pros du bâtiment' == $univers->name ) {
            $array[] = [
                'label' => $univers->name,
                'url' => get_home_url() . "/pros"
            ];    
        } else if ( 'Référence'    != $univers->name 
                 && 'Contact'      != $univers->name 
                 && 'La marque'    != $univers->name ) {
            $array[] = [
                'label' => $univers->name,
                'url' => get_home_url() . "/" . $univers->slug
            ];    
        }
        
        // store the $half_slug (might be used depending on post types)
        switch ($univers->name) {
            case 'Pros du bâtiment':
                $half_slug = 'pros';
                break;
            default: 
                $half_slug = $univers->slug;
        }
    }
    
    // Guess the page type
    $post_type = get_post_type();
    
    // Get page template
    $template = basename( get_page_template() );
    
    
    // Do things accordingly
    switch ($post_type) {
        case 'product':
            $terms = get_the_terms( $post->ID, 'gamme' );
            if ( !empty( $terms ) ) {
                $gamme = array_shift( $terms );
            }
            
            $category_post = get_page_by_path( 'produits-' . $half_slug . '/' . $gamme->slug );
                
            if (!!$category_post) {
                
                $array[] = [ 
                    'label' => get_the_title( $category_post ), 
                    'url' => get_page_link( $category_post ) 
                ];
            } // else { // debug only
            //     $array[] = [ 
            //         'label' => "cant find parent page, wrong slug suspected", 
            //         'url' => "gamme: " . $gamme->slug 
            //     ];
            // }
            
            break;
        case 'advice':
            $category_post = get_page_by_path( 'conseils-' . $half_slug );
            
            if (!!$category_post) {
                
                $array[] = [ 
                    'label' => get_the_title( $category_post ), 
                    'url' => get_page_link( $category_post ) 
                ];
            } // else { // debug only
            //     $array[] = [ 
            //         'label' => "cant find parent page, wrong slug suspected", 
            //         'url' => "gamme: " . $gamme->slug 
            //     ];
            // }
            break;
            
        case 'page':
            if ( 'template-page-home-pro.php' === $template
              || 'template-page-template-home-prescripteurs.php' === $template 
              || 'template-page-home-industriels.php' === $template ) {
                // in case we are on universe homepage, remove last array URL
                $i = count( $array ) - 1;
                $array[$i]['url'] = null;
            } elseif ( 'template-page-liste-produits.php' == basename(get_page_template()) ) {
                // do nothing
            }
            break;
            
        case 'catalogue':
            $category_post = get_page_by_path( 'catalogues-' . $half_slug );
            if (!!$category_post) {
                $array[] = [ 
                    'label' => get_the_title( $category_post ), 
                    'url' => get_page_link( $category_post ) 
                ];
            } // else { // debug only
            //     $array[] = [ 
            //         'label' => "cant find parent page, wrong slug suspected", 
            //         'url' => "gamme: " . $gamme->slug 
            //     ];
            // }
            break;
        case 'video':
            $half_slug = 'pros' == $half_slug ? 'pro-du-batiment' : $half_slug;
            
            $category_post = get_page_by_path( 'videos-' . $half_slug );
            if (!!$category_post) {
                $array[] = [ 
                    'label' => get_the_title( $category_post ), 
                    'url' => get_page_link( $category_post ) 
                ];
            } // else { // debug only
            //     $array[] = [ 
            //         'label' => "cant find parent page, wrong slug suspected", 
            //         'url' => "tested half_slug: " . $half_slug
            //     ];
            // }
            break;
        case 'nuancier':
            $args = [
                'post_type' => 'page',
                'fields' => 'ids',
                'nopaging' => true,
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-page-nuancier.php',
                
                // this tax_query makes only the "prescripteur" nuancier stand out
                'tax_query' => array(array(
                        'taxonomy' => 'univers',
                        'terms' => 'prescripteurs', // $univers->slug
                        'field' => 'slug'
                ))
            ];
            $pages_ids = get_posts( $args );
            foreach ( $pages_ids as $page_id ) {
                $array[] = [
                    'label' => get_the_title( $page_id ),
                    'url' => get_page_link( $page_id )
                ];
            }
            
            break;
        case 'reference':
            $args = [
                'post_type' => 'page',
                'fields' => 'ids',
                'nopaging' => true,
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-page-liste-references.php'
            ];
            
            // if ( count($array) == 2 ) {
            //     $args['tax_query'] = array(array(
            //         'taxonomy' => 'univers',
            //         'terms' => $univers->slug,
            //         'field' => 'slug'
            //     ));
            // }
            
            $pages_ids = get_posts( $args );
            
            $half_slug = 'pros' == $half_slug ? 'professionnels' : $half_slug;
            
            $already_found_one = false;
            foreach ( $pages_ids as $page_id ) {
                if ( $already_found_one ) {
                    break;
                } elseif ( str_contains( get_page_link($page_id), $half_slug ) ) {
                    $array[] = [
                        'label' => get_the_title( $page_id ),
                        'url' => get_page_link( $page_id )
                    ];
                    $already_found_one = true;
                }
            }
            
            break;
        case 'testimony':
            $all_testimonies = get_page_by_path( 'temoignages' );
            $array[] = [
                'label' => get_the_title( $all_testimonies ),
                'url' => get_page_link( $all_testimonies )
            ];
            break;
        default:
            break;
    }
    
    // Add current page (unless we are on any universe homepage)
    if ( 'template-page-home-pro.php' !== $template
      && 'template-page-template-home-prescripteurs.php' !== $template 
      && 'template-page-home-industriels.php' !== $template ) {
        
        $array[] = [ 
            'label' => get_the_title(), 
            'url' => null 
        ];
    }
    
    
    return $array;
}
/** function console_log
 * A handy tool to log stuff to the webtools console
 *
 * @param array $something  The data to be logged in the console
 * 
 * @return string           A string ready to be echoed in the DOM
 */ 
function console_log($something): string {
    return '<script>console.log(' . $something .  ')</script>'; 
}

/** function jsonld_breadcrumb
 * Build and return JSON-LD code to be placed in the DOM
 *
 * @param array $array  The array used to build the json-ld data
 * 
 * @return string       The JSON-LD representation of the breadcrumb
 */ 
function jsonld_breadcrumb($array): string {
    if ( !$array ) {
        // error_log( 'houston, $array is null (in 1.5.0/functions.php on line 1810)' );
        return '</script><pre style="display: none;">Can\'t build JSON-LD breadcrumb ($array argument is null).</pre><script>';
    }
    
    $item_list_element = [];
    
    for ($i = 0; $i < count($array); $i++) {
        $item = [
            "@type" => "ListItem",
            "position" => $i + 1,
            "name" => $array[$i]["label"]
        ];
        if ( isset($array[$i]["url"]) ) {
            $item["item"] = $array[$i]["url"];
        }
        $item_list_element[] = $item;
    }
    
    
    $array = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => $item_list_element
    ];
    
    return json_encode( $array, JSON_UNESCAPED_SLASHES );
}

/** function dom_breadcrumb
 * Build and return a HTML string to be placed in the DOM
 *
 * @param array $array  The array used to build the HTML code
 * 
 * @return string       A string ready to be echoed in the DOM
 */ 
function dom_breadcrumb($array): string {
    if ( !$array ) {
        // error_log( 'houston, $array is null (in 1.5.0/functions.php on line 1847)' );
        return '<pre style="display: none;">Can\'t build JSON-LD breadcrumb ($array argument is null).</pre>';
    }
    $result = '<nav aria-label="Fil d\'Ariane" class="guardindustrie-breadcrumb"><ol>';
    
    foreach ($array as $item) {
        $el = '<li>';
        $el .= isset($item["url"]) ? '<a href="' . $item["url"] . '">' : '<span aria-current="page">';
        $el .= html_entity_decode( $item["label"] ); // don't forget to truncate with CSS when too long
        $el .= isset($item["url"]) ? '</a>' : '</span>';
        $el .= '</li>';
        
        $result .= $el;
    }
    
    $result .= '</ol>';
    
    return $result;
}



function no_height_sir($string) {
	$pattern = '/height/';
	return !preg_match($pattern, $string);
}
/** 
 * Returns a valid image tag
 * 
 * @param array $image_array | The wordpress array containing the file and its specs.
 * @param string $source_id  | If $media_array is 'featured_image', indicate here the ID of the post. Defaults to current post.
 * 
 * @return string			 | The html attributes inside of the img tag (incuding srcset & loading). You should add (at least) sizes and alt attributes.
 */
function rawww_image_srcset( $media_array, $source_id = null )
{
	if ( !$media_array ) {
		return 'data-src-error="no featured image set or missing argument"';
	} elseif ( $media_array == 'featured_image' ) { // if requesting featured image
		
		$data = wp_get_attachment_metadata( get_post_thumbnail_id( $source_id ) );
		$original_url = wp_get_attachment_url( get_post_thumbnail_id( $source_id ) );
		
		preg_match('/\.svg$/', $original_url, $matches); // if featured image is svg
		if ($matches) {
			return 'src="' . $original_url . '" loading="lazy"';
		}
		
		$sizes_arrays = $data['sizes'];
		$answer = 'srcset="';
		
		
		if ($original_url == false) { // if no featured image set
			return 'data-src-error="featured image not set"';
		}
		
		if (count($sizes_arrays) == 0) { // if only one size available
			$answer = 'src=' . $original_url . '" loading="lazy"';
			return $answer;
		}
		
		preg_match('/\/([^\/]+)\/?$/', $original_url, $matches);
		$url = rtrim($original_url, $matches[1]);
	
		foreach ( $sizes_arrays as $size ) {
			$answer .= $url . $size['file'] . ' ' . $size['width'] . 'w, ';
		}
		$answer = rtrim($answer, ", ");
		
		$answer .= '" src="' . $original_url . '" loading="lazy"';
		return $answer;
		
	} else { // if requesting something else that 'featured image'
		preg_match('/\.svg$/', $media_array['mime_type'], $matches); // if requested image is svg
		if ($matches) {
			return 'src="' . $media_array['url'] . '" loading="lazy"';
		}
		
		$sizes = $media_array['sizes'];
	
		$filtered = array_values( array_filter($sizes, 'no_height_sir', ARRAY_FILTER_USE_KEY) );
		
		$len = count($filtered);
		$answer = 'srcset="';
		for ($i = 0, $previous_width = ''; $i < $len; $i += 2)
		{
			if ($filtered[$i+1] != $previous_width) {
				$previous_width = $filtered[$i+1];
				$answer .= $filtered[$i] . ' ' . $filtered[$i+1] . 'w, ';
			}
		}
		$answer = rtrim($answer, ", ");
		
		$medium_large = $media_array['sizes']['medium_large'];
		return $answer . '" src="' . $medium_large . '" loading="lazy"';
	}
	
}


function guard_get_all_terms_for($taxo_name) {
    $array = [];
    $terms = get_terms([
        'taxonomy' => $taxo_name,
        'hide_empty' => true,
    ]);
    foreach ($terms as $term) {
        $array[] = [
            'label' => $term->name, 
            'slug' => $term->slug
        ];
    }
    return $array;
}



/* Remove Yoast SEO Add custom title or meta template variables
 * Credit: Moshe Harush
 * https://stackoverflow.com/questions/36281915/yoast-seo-how-to-create-custom-variables
 * Last Tested: Nov 29 2018 using Yoast SEO 9.2.1 on WordPress 4.9.8
 *******
 * NOTE: The snippet preview in the backend will show the custom variable '%%myname%%'.
 * However, the source code of your site will show the output of the variable 'My name is Moses'.
 */

// define the custom replacement callback
function get_productlist_gamme_str() {
    if ( isset($_GET["_product_gamme"]) ) {
        $gammes = explode(',', $_GET["_product_gamme"]);
        
        $gamme_str = '';
        foreach ($gammes as $gamme_slug) {
            $temp = get_term_by('slug', $gamme_slug, 'gamme');
            $gamme_str .= ucfirst($temp->name) . ' et ';
        }
        $gamme_str = substr($gamme_str, 0, -4);
        return $gamme_str;
    }
    return '';
}
function get_productlist_support_str() {
    if ( isset($_GET["_product_support"]) ) {
        $supports = explode(',', $_GET["_product_support"]);
        
        $support_str = ' pour ';
        foreach ($supports as $support_slug) {
            $temp = get_term_by('slug', $support_slug, 'support');
            $support_str .= ucfirst($temp->name) . ' et ';
        }
        $support_str = substr($support_str, 0, -4);
        return $support_str;
    }
    return '';
}
function get_product_properties_str() {
    $terms = wp_get_object_terms( get_queried_object_id(), 'property');
    
    if (!$terms) {
        return;
    }
    // else
    $properties_str = $terms[0]->name . ' ';
    
    if ( count($terms) > 1 ) {
        $properties_str .= $terms[1]->name . ' ';
    }
    
    return $properties_str;
}
function get_product_supports_str() {
    $terms = wp_get_object_terms( get_queried_object_id(), 'support');
    
    if (!$terms) {
        return;
    }
    // else
    $properties_str = '';
    foreach ($terms as $term) {
        $properties_str .= $term->name . ' ';
    }
    
    return $properties_str;
}

function rawww_replace_last_occurence($string, $find, $replace): string {
    $result = preg_replace( strrev("/$find/"), strrev($replace), strrev($string),1 );
    return strrev($result);
}


function get_product_variations_str() {
    $product = wc_get_product();
    
    
    if ($product->is_type( 'simple' )) {
        return;
    }

    
    $variations = $product->get_available_variations();
    
    if ( $variations ) {
        $variations_str = ' ';
        foreach ($variations as $var) {
            $variations_str .= strtoupper( $var['attributes']['attribute_pa_volume'] ) . ', ';
        }
        $variations_str = substr($variations_str, 0, -2);
        $variations_str = rawww_replace_last_occurence($variations_str, ', ', ' ou ');
        
        return $variations_str . '.';
    }
    return;
}

// define the action for register yoast_variable replacments
function register_custom_yoast_variables() {
    wpseo_register_var_replacement( '%%productlist_gammes%%', 'get_productlist_gamme_str', 'advanced', 'some help text' );
    wpseo_register_var_replacement( '%%productlist_supports%%', 'get_productlist_support_str', 'advanced', 'some help text' );
    
    wpseo_register_var_replacement( '%%product_properties%%', 'get_product_properties_str', 'advanced', 'some help text' );
    wpseo_register_var_replacement( '%%product_supports%%', 'get_product_supports_str', 'advanced', 'some help text' );
    wpseo_register_var_replacement( '%%product_contenances%%', 'get_product_variations_str', 'advanced', 'some help text' );
}

// Add action
add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');

function guard_shortcode_productlist_auto_content() {
    $gamme_str = get_productlist_gamme_str();
    
    $support_str = get_productlist_support_str();
    
    return '<h2>Découvrez '. strtolower( get_the_title() ) .' '. $gamme_str . ' ' . $support_str . ' hauts de gamme et écologiques.</h2>
    <p>Bénéficiez de conseil sur l\'utilisation de nos produits' . $support_str . '.</p>';
}
add_shortcode('guard_productlist_auto_content', 'guard_shortcode_productlist_auto_content');






/* Change the canonical link for the product-list pages
 * Credit: Scott Weiss of somethumb.com
 * Last Tested: Jan 25 2017 using Yoast SEO 6.0 on WordPress 4.9.1
 */
function guard_yoast_seo_canonical_change_productlist( $canonical ) {
    if ( !is_page_template('template-page-liste-produits.php') ) {
		return $canonical;
	}
	if ( !$_SERVER["QUERY_STRING"] ) {
	    return $canonical;
	}
// 	if ( str_contains($_SERVER["QUERY_STRING"], "%2C") ) {
// 	    return $canonical;
// 	}
	if ( $_SERVER["QUERY_STRING"] ) {
	   // return $_SERVER["QUERY_STRING"];
	    $args = explode("&", $_SERVER["QUERY_STRING"]);
	    
	    /* Robots: "On autorise propriétés seules" */
	    global $wp;
	    if ( count($args) == 1 ) {
	        return str_contains($args[0], "_product_properties") ? home_url( $wp->request ) . '/?' . urlencode( $_SERVER['QUERY_STRING'] ) : $canonical;
	    }
	    /* Robots: "On autorise propriétés + {support | matériaux} " */
	    /* Robots: "On autorise gamme + {support | matériaux} " */
	    /* Robots: "On bloque propriétés + {support | matériaux} + autre chose" */
	    /* Robots: "On bloque gamme + {support | matériaux} + autre chose" */
	    
	    // from now on, we know there are multiple args
	    $properties_array = [
	        'value' => null,
	        'index' => null
	    ];
	    $gamme_array = [
	        'value' => null,
	        'index' => null
	    ];
	    $support_array = [
	        'value' => null,
	        'index' => null
	    ];
	    $materials_array = [
	        'value' => null,
	        'index' => null
	    ];
	    
	    $properties_frag = '';
	    $gamme_frag = '';
	    $end_frag = '';
	    foreach($args as $arg) {
            if ( stripos($arg, "_product_properties") !== false ) {
                // $properties_frag .= $arg;
                $properties_array = [
                    'value' => $arg,
                    'index' => array_search($arg, $args)
                ];
            }
            if ( stripos($arg, "_product_gamme") !== false ) {
                // $gamme_frag .= $arg;
                $gamme_array = [
                    'value' => $arg,
                    'index' => array_search($arg, $args)
                ];
            }
            if ( stripos($arg, "_product_support") !== false ) {
                $support_array = [
                    'value' => $arg,
                    'index' => array_search($arg, $args)
                ];
            }
            if ( stripos($arg, "_product_materials") !== false ) {
                $materials_array = [
                    'value' => $arg,
                    'index' => array_search($arg, $args)
                ];
            }
        }
        
        
        // guess priority between support and material
        // both support and materials
        if ( $support_array['value'] && $materials_array['value'] ) {
            $end_frag .= $support_array['index'] < $materials_array['index'] ? $support_array['value'] : $materials_array['value'];
        } 
        // neither support nor materials
        elseif (!$support_array['value'] && !$materials_array['value']) {
            $endfrag = false;
        } 
        // any of 'em
        else {
            $end_frag .= $support_array['value'] . $materials_array['value'];
        }
        
        
        
        // si ya ni support ni materiaux, on renvoie propriété (ou rien)
        if ( $end_frag == false ) {
            return $properties_array['value'] ? home_url( $wp->request ) . '/?' . urlencode( $properties_array['value'] ) : $canonical;
        }
        
        // from now on, consider $end_frag == true
        $start_frag = '';
        
        // if we have both property and gamme
        if ( $properties_array['value'] && $gamme_array['value'] ) {
            $start_frag .= $properties_array['index'] < $gamme_array['index'] ? $properties_array['value'] : $gamme_array['value'];
            $result = implode("&", [$start_frag, $end_frag] );
            return home_url( $wp->request ) . '/?' . urlencode( $result );
        }
        // neither property nor gamme
        elseif ( !$properties_array['value'] && !$gamme_array['value'] ) {
            return $canonical;
        }
        // any of 'em
        else {
            $start_frag = $properties_array['value'] . $gamme_array['value'];
            $result = implode("&", [$start_frag, $end_frag] );
            return home_url( $wp->request ) . '/?' . urlencode( $result );
        }
        
	    return 'not_allowed'; // debug only
	    return $canonical;
	}
	
// 	global $wp;
    // return add_query_arg( $wp->query_vars, home_url( $wp->request ) );
    // return home_url( $wp->request ) . '/?' . urlencode( $_SERVER['QUERY_STRING'] );
}
add_filter( 'wpseo_canonical', 'guard_yoast_seo_canonical_change_productlist', 10, 1 );


function jsonld_product() {
    $product =  wc_get_product();
    $image_id  = $product->get_image_id();
    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
    return '{
        "@context": "http://schema.org",
        "@type": "Product",
        "name": "'. $product->get_title() .'",
        "image": "'. $image_url .'",
        "brand": {
            "@context": "http://schema.org",
            "@type": "Brand",
            "name": "Guard Industrie",
            "logo": "'. get_template_directory_uri() .'/images/logo.png"
        },
        "offers": {
            "@context": "http://schema.org",
            "@type": "Offer",
            "price": "'. wc_get_price_to_display( $product, array( 'price' => $product->get_price() ) ) .'",
            "priceCurrency": "EUR"
        }
    }';
}


/**
 * Get creation date of a post
 */
function get_creation_date( $entry_id = '' ) {
  $post_id  = $entry_id ? $entry_id : get_the_ID();
  $old_date = get_post_meta( $post_id, '_wp_old_date', true );
  return $old_date ? date_i18n( 'c', strtotime( $old_date ) ) : get_the_date('c');
}

function video_structured_data( $post ) {
    $iframe = get_field( 'video_link', $post );
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $iframe_src = $matches[1];
    
    $jsondata_array = [
        "@context" => "https://schema.org",
        "@type" => "VideoObject",
        "description" => get_the_title(),
        "name" => get_the_title(),
        "uploadDate" => get_creation_date(),
        "embedUrl" => $iframe_src
    ];
    
    $string = get_field( 'video_link' );
    $pattern = '/watch\?v=(.*)$/';
    if ( preg_match($pattern, $string, $matches) ) {
        $jsondata_array[] = [
            "thumbnailUrl" => "https://img.youtube.com/vi/". $matches[0] ."/maxresdefault.jpg"
        ];
    }
    
    return json_encode( $jsondata_array, JSON_UNESCAPED_SLASHES );
}


// define the wpseo_sitemap_<type>_content callback 
function guard_filter_wpseo_sitemap_type_content( $var ) { 
    // make filter magic happen here... 
    $entries = str_replace(
        '&',
        '&amp;',
        [
            "?_product_gamme=nettoyant-et-decapant&_product_materials=ardoise",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=beton",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=bois",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=brique",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=carrelage",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=enduit",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=granit",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=marbre",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=metal",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=pierre-naturelle",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=pierre-reconstituee",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=plastique",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=terre-cuite",
            "?_product_gamme=nettoyant-et-decapant&_product_materials=travertin",
            "?_product_gamme=nettoyant-et-decapant&_product_support=mur-facade",
            "?_product_gamme=nettoyant-et-decapant&_product_support=sol",
            "?_product_gamme=nettoyant-et-decapant&_product_support=toiture",
            "?_product_gamme=protection&_product_materials=beton",
            "?_product_gamme=protection&_product_materials=bois",
            "?_product_gamme=protection&_product_materials=bois-composite",
            "?_product_gamme=protection&_product_materials=carrelage",
            "?_product_gamme=protection&_product_materials=marbre",
            "?_product_gamme=protection&_product_materials=metal",
            "?_product_gamme=protection&_product_materials=pierre-naturelle",
            "?_product_gamme=protection&_product_materials=plastique",
            "?_product_gamme=protection&_product_materials=travertin",
            "?_product_gamme=protection&_product_properties=anti-graffitis",
            "?_product_gamme=protection&_product_support=mur-facade",
            "?_product_gamme=protection&_product_support=sol",
            "?_product_gamme=protection&_product_support=toiture",
            "?_product_gamme=traitement-et-mineralisation&_product_materials=beton",
            "?_product_gamme=traitement-et-mineralisation&_product_materials=travertin",
            "?_product_gamme=traitement-et-mineralisation&_product_support=mur-facade",
            "?_product_gamme=traitement-et-mineralisation&_product_support=sol",
            "?_product_properties=anti-calcaire-et-detartrant",
            "?_product_properties=anti-calcaire-et-detartrant&_product_materials=carrelage",
            "?_product_properties=anti-calcaire-et-detartrant&_product_support=mur-facade",
            "?_product_properties=anti-calcaire-et-detartrant&_product_support=sol",
            "?_product_properties=anti-depots-verts&_product_support=mur-facade",
            "?_product_properties=anti-depots-verts&_product_support=sol",
            "?_product_properties=anti-depots-verts&_product_support=toiture",
            "?_product_properties=antiderapant&_product_materials=carrelage",
            "?_product_properties=antiderapant&_product_support=sol",
            "?_product_properties=anti-graffitis",
            "?_product_properties=anti-rouille&_product_materials=carrelage",
            "?_product_properties=anti-rouille&_product_materials=metal",
            "?_product_properties=anti-taches&_product_materials=textile",
            "?_product_properties=anti-taches&_product_support=mur-facade",
            "?_product_properties=anti-taches&_product_support=sol",
            "?_product_properties=anti-taches&_product_support=toiture",
            "?_product_properties=beton-cire",
            "?_product_properties=beton-cire&_product_support=sol",
            "?_product_properties=cire-de-protection&_product_support=sol",
            "?_product_properties=consolidant-durcisseur&_product_materials=beton",
            "?_product_properties=consolidant-durcisseur&_product_materials=enduit",
            "?_product_properties=consolidant-durcisseur&_product_materials=platre",
            "?_product_properties=consolidant-durcisseur&_product_support=mur-facade",
            "?_product_properties=consolidant-durcisseur&_product_support=sol",
            "?_product_properties=decapant-laitance-et-voile-de-ciment&_product_materials=carrelage",
            "?_product_properties=decapant-laitance-et-voile-de-ciment&_product_materials=pierre-naturelle",
            "?_product_properties=decapant-peinture-et-vernis&_product_materials=beton",
            "?_product_properties=decapant-peinture-et-vernis&_product_materials=bois",
            "?_product_properties=decapant-peinture-et-vernis&_product_materials=brique",
            "?_product_properties=decapant-peinture-et-vernis&_product_materials=metal",
            "?_product_properties=decapant-peinture-et-vernis&_product_materials=pierre-naturelle",
            "?_product_properties=decapant-peinture-et-vernis&_product_support=mur-facade",
            "?_product_properties=degriseur-bois",
            "?_product_properties=finition-incolore&_product_support=mur-facade",
            "?_product_properties=finition-incolore&_product_support=sol",
            "?_product_properties=finition-incolore&_product_support=toiture",
            "?_product_properties=fongicide&_product_materials=bois",
            "?_product_properties=fongicide&_product_support=mur-facade",
            "?_product_properties=fongicide&_product_support=sol",
            "?_product_properties=fongicide&_product_support=toiture",
            "?_product_properties=hydrofuge-effet-mouille&_product_materials=carrelage",
            "?_product_properties=hydrofuge-effet-mouille&_product_materials=travertin",
            "?_product_properties=impermeabilisant&_product_materials=ardoise",
            "?_product_properties=impermeabilisant&_product_materials=beton",
            "?_product_properties=impermeabilisant&_product_materials=bois",
            "?_product_properties=impermeabilisant&_product_materials=brique",
            "?_product_properties=impermeabilisant&_product_materials=carrelage",
            "?_product_properties=impermeabilisant&_product_materials=enduit",
            "?_product_properties=impermeabilisant&_product_materials=granit",
            "?_product_properties=impermeabilisant&_product_materials=marbre",
            "?_product_properties=impermeabilisant&_product_materials=mortier",
            "?_product_properties=impermeabilisant&_product_materials=terre-cuite",
            "?_product_properties=impermeabilisant&_product_materials=textile",
            "?_product_properties=impermeabilisant&_product_materials=travertin",
            "?_product_properties=impermeabilisant&_product_support=mur-facade",
            "?_product_properties=impermeabilisant&_product_support=sol",
            "?_product_properties=impermeabilisant&_product_support=toiture",
            "?_product_properties=nettoyant-degraissant&_product_materials=beton",
            "?_product_properties=nettoyant-degraissant&_product_materials=bois",
            "?_product_properties=nettoyant-degraissant&_product_materials=carrelage",
            "?_product_properties=nettoyant-degraissant&_product_materials=metal",
            "?_product_properties=nettoyant-degraissant&_product_materials=plastique",
            "?_product_properties=nettoyant-degraissant&_product_support=mur-facade",
            "?_product_properties=nettoyant-degraissant&_product_support=sol",
            "?_product_properties=nettoyant-graffitis",
            "?_product_properties=nettoyant-pollution-encrassement&_product_support=mur-facade",
            "?_product_properties=nettoyant-pollution-encrassement&_product_support=sol",
            "?_product_properties=nettoyant-pollution-encrassement&_product_support=toiture",
            "?_product_properties=nettoyant-salissures-organiques&_product_support=mur-facade",
            "?_product_properties=nettoyant-salissures-organiques&_product_support=sol",
            "?_product_properties=nettoyant-salissures-organiques&_product_support=toiture",
            "?_product_properties=traitement-remontees-capillaires&_product_support=mur-facade",
            "?_product_properties=traitement-salpetre-humidite&_product_materials=beton",
            "?_product_properties=traitement-salpetre-humidite&_product_materials=brique",
            "?_product_properties=traitement-salpetre-humidite&_product_support=mur-facade",
            "?_product_properties=traitement-salpetre-humidite&_product_support=sol"
        ]
    );
    $radical = home_url() . '/produits-particuliers/';
    foreach ( $entries as $entry ) {
        $var .= "<url><loc>". $radical . $entry ."</loc></url>";
    }
    return $var; 
}; 
// add the filter
function guard_add_entries_to_product_sitemap() {
    $type = 'product';
    add_filter( "wpseo_sitemap_{$type}_content", 'guard_filter_wpseo_sitemap_type_content', 10, 1 );
}
guard_add_entries_to_product_sitemap();

// add_action( 'wp_head', 'show_styles_in_header', 9999 );
// add_action( 'wp_footer', 'show_ctyles_in_footer', 9999 );
// // JavaScripts appear on the top, before the header
// function show_styles_in_header(){
// global $wp_styles;echo '<pre>'; 
// print_r($wp_styles->done); echo '</pre>';
// }
// // JavaScripts appear on the bottom, after the footer
// function show_styles_in_footer(){
// global $wp_styles;echo '<pre>';
// print_r($wp_styles->done); echo '</pre>';
// }

add_filter( 'style_loader_tag', 'defer_styles_myhostingfacts', 10, 3 );
function defer_styles_myhostingfacts( $tag, $handle, $src ) {
    // The handles of the enqueued scripts we want to defer
    $defer_styles = [
        'wp-block-library',
        'wc-blocks-style',
        'global-css',
    ];
    if ( in_array( $handle, $defer_styles ) ) {
        return '<link rel="preload" id="'. $handle .'-css" href="'. $src .'" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" type="text/css" media="all"><noscript><link rel="stylesheet" href="'. $src .'"></noscript>' . "\n";
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'defer_scripts_myhostingfacts', 10, 3 );
function defer_scripts_myhostingfacts( $tag, $handle, $src ) {
    // The handles of the enqueued scripts we want to defer
    $defer_scripts = [
        // 'jquery-core', // defering jquery-core mess up with a lot of scripts..
        'jquery-migrate',
        'sib-front-js'
    ];
    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
    return $tag;
}