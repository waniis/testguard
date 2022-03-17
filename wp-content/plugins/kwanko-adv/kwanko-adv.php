<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.kwanko.com
 * @since             1.0.0
 * @package           Kwanko_Adv
 *
 * @wordpress-plugin
 * Plugin Name:       Kwanko - Tracking Tags for Advertisers
 * Plugin URI:        https://www.kwanko.com/
 * Description:       WooCommerce plugin that handles the setup of the kwanko tracking tags for the advertisers.
 * Version:           1.2.2
 * Author:            Kwanko
 * Author URI:        https://www.kwanko.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kwanko-adv
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KWANKO_ADV_VERSION', '1.2.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kwanko-adv-activator.php
 */
function activate_kwanko_adv() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwanko-adv-activator.php';
	Kwanko_Adv_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kwanko-adv-deactivator.php
 */
function deactivate_kwanko_adv() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwanko-adv-deactivator.php';
	Kwanko_Adv_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kwanko_adv' );
register_deactivation_hook( __FILE__, 'deactivate_kwanko_adv' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kwanko-adv.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kwanko_adv() {

	$plugin = new Kwanko_Adv();
	$plugin->run();

}
run_kwanko_adv();
