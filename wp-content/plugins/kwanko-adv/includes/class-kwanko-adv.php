<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.kwanko.com
 * @since      1.0.0
 *
 * @package    Kwanko_Adv
 * @subpackage Kwanko_Adv/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Kwanko_Adv
 * @subpackage Kwanko_Adv/includes
 * @author     Kwanko <support@kwanko.com>
 */
class Kwanko_Adv {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Kwanko_Adv_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'KWANKO_ADV_VERSION' ) ) {
			$this->version = KWANKO_ADV_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'kwanko-adv';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Kwanko_Adv_Loader. Orchestrates the hooks of the plugin.
	 * - Kwanko_Adv_i18n. Defines internationalization functionality.
	 * - Kwanko_Adv_Admin. Defines all hooks for the admin area.
	 * - Kwanko_Adv_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kwanko-adv-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kwanko-adv-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-kwanko-adv-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-kwanko-adv-public.php';

		$this->loader = new Kwanko_Adv_Loader();

		// kwanko related dependencies
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/kwanko/class-kwanko-adv-mclic-decoder.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/kwanko/class-kwanko-adv-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/kwanko/class-kwanko-adv-tags.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Kwanko_Adv_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Kwanko_Adv_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Kwanko_Adv_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_option_page' );
		$this->loader->add_filter( 'plugin_action_links_kwanko-adv/kwanko-adv.php', $plugin_admin, 'add_action_links' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Kwanko_Adv_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'user_register', $plugin_public, 'user_register' );
		$this->loader->add_action( 'woocommerce_register_form', $plugin_public, 'woocommerce_register_form' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'add_to_header' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'add_to_footer' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Kwanko_Adv_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
