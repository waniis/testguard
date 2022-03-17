<?php
/**
 * Plugin Name: Taxonomy/Term and Role based Discounts for WooCommerce
 * Plugin URI: https://www.webdados.pt/wordpress/plugins/taxonomy-term-based-discounts-for-woocommerce/
 * Description: "Taxonomy/Term based Discounts for WooCommerce" lets you configure discount/pricing rules for products based on any product taxonomy terms and WordPress user roles
 * Version: 2.0.0
 * Author: Webdados
 * Author URI: https://www.webdados.pt
 * Text Domain: taxonomy-discounts-woocommerce
 * Domain Path: /languages
 * Requires at least: 4.7
 * WC tested up to: 5.3
**/

/* Partially WooCommerce CRUD ready - Term metas are still fetched from the database using WP_Query for filtering and performance reasons */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/* Our own order class and the main classes */
add_action( 'plugins_loaded', 'wctd_init', 1 );
function wctd_init() {
	if ( class_exists( 'WooCommerce' ) && defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0', '>=' ) ) {
		require_once( 'includes/class-wc-taxonomy-discounts-webdados.php' );
		require_once( 'includes/helpers.php' );
		$GLOBALS['WC_Taxonomy_Discounts_Webdados'] = WC_Taxonomy_Discounts_Webdados();
	} else {
		add_action( 'admin_notices', 'wctd_init_no_woocommerce' );
	}
}

/* Main class */
function WC_Taxonomy_Discounts_Webdados() {
	return WC_Taxonomy_Discounts_Webdados::instance();
}

function wctd_init_no_woocommerce() {
	?>
	<div id="message" class="error">
		<p><?php
			_e( '<strong>Taxonomy/Term and Role based Discounts for WooCommerce</strong> is enabled but not effective. It requires <strong>WooCommerce</strong> in order to work.',  'taxonomy-discounts-woocommerce' );
		?></p>
	</div>
	<?php
}

/* If you're reading this you must know what you're doing ;-) Greetings from sunny Portugal! */
