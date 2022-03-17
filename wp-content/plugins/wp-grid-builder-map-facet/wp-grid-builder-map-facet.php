<?php
/**
 * WP Grid Builder Map Facet Add-on
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @link      https://www.wpgridbuilder.com
 * @copyright 2019-2021 Loïc Blascos
 *
 * @wordpress-plugin
 * Plugin Name:  WP Grid Builder - Map Facet
 * Plugin URI:   https://www.wpgridbuilder.com
 * Description:  Add maps from Google Map, Mapbox or Leaflet to display markers and to filter.
 * Version:      1.1.5
 * Author:       Loïc Blascos
 * Author URI:   https://www.wpgridbuilder.com
 * License:      GPL-3.0-or-later
 * License URI:  https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:  wpgb-map-facet
 * Domain Path:  /languages
 */

namespace WP_Grid_Builder_Map_Facet;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPGB_MAP_VERSION', '1.1.5' );
define( 'WPGB_MAP_FILE', __FILE__ );
define( 'WPGB_MAP_BASE', plugin_basename( WPGB_MAP_FILE ) );
define( 'WPGB_MAP_PATH', plugin_dir_path( WPGB_MAP_FILE ) );
define( 'WPGB_MAP_URL', plugin_dir_url( WPGB_MAP_FILE ) );

require_once WPGB_MAP_PATH . 'includes/class-autoload.php';

/**
 * Load plugin text domain.
 *
 * @since 1.0.0
 */
function textdomain() {

	load_plugin_textdomain(
		'wpgb-map-facet',
		false,
		basename( dirname( WPGB_MAP_FILE ) ) . '/languages'
	);

}
add_action( 'plugins_loaded', __NAMESPACE__ . '\textdomain' );

/**
 * Plugin compatibility notice.
 *
 * @since 1.0.0
 */
function admin_notice() {

	$notice = __( '<strong>Gridbuilder ᵂᴾ - Map Facet</strong> add-on requires at least <code>Gridbuilder ᵂᴾ v1.1.5</code>. Please update Gridbuilder ᵂᴾ to use Map Facet add-on.', 'wpgb-map-facet' );

	echo '<div class="error">' . wp_kses_post( wpautop( $notice ) ) . '</div>';

}

/**
 * Initialize plugin
 *
 * @since 1.0.0
 */
function loaded() {

	if ( version_compare( WPGB_VERSION, '1.1.5', '<' ) ) {

		add_action( 'admin_notices', __NAMESPACE__ . '\admin_notice' );
		return;

	}

	new Includes\Plugin();

}
add_action( 'wp_grid_builder/loaded', __NAMESPACE__ . '\loaded' );
