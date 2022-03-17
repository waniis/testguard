<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.kwanko.com
 * @since      1.0.0
 *
 * @package    Kwanko_Adv
 * @subpackage Kwanko_Adv/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Kwanko_Adv
 * @subpackage Kwanko_Adv/includes
 * @author     Kwanko <support@kwanko.com>
 */
class Kwanko_Adv_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kwanko-adv',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
