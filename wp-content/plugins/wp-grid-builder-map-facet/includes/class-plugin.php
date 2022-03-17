<?php
/**
 * Plugin
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

namespace WP_Grid_Builder_Map_Facet\Includes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Instance of the plugin
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Plugin
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'wp_grid_builder/init', [ $this, 'init' ] );
		add_filter( 'wp_grid_builder/register', [ $this, 'register' ] );
		add_filter( 'wp_grid_builder/plugin_info', [ $this, 'plugin_info' ], 10, 2 );
		add_filter( 'wp_grid_builder/cards_demo', [ $this, 'add_card_demo' ], 10, 2 );
		add_filter( 'wp_grid_builder/grids_demo', [ $this, 'add_grid_demo' ], 10, 2 );
		add_filter( 'wp_grid_builder_i18n/card/register_strings', [ $this, 'register_card_strings' ] );
		add_filter( 'wp_grid_builder_i18n/facet/register_strings', [ $this, 'register_facet_strings' ] );

	}

	/**
	 * Init instances
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		new Settings();
		new Facets();
		new Block();
		new Sort();

	}

	/**
	 * Register add-on
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $addons Holds registered add-ons.
	 * @return array
	 */
	public function register( $addons ) {

		$addons[] = [
			'name'    => 'Map Facet',
			'slug'    => WPGB_MAP_BASE,
			'option'  => 'wpgb_map_facet',
			'version' => WPGB_MAP_VERSION,
		];

		return $addons;

	}

	/**
	 * Set plugin info
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array  $info Holds plugin info.
	 * @param string $name Current plugin name.
	 * @return array
	 */
	public function plugin_info( $info, $name ) {

		if ( 'Map Facet' !== $name ) {
			return $info;
		}

		$info['icons'] = [
			'1x' => WPGB_MAP_URL . 'assets/imgs/icon.png',
			'2x' => WPGB_MAP_URL . 'assets/imgs/icon.png',
		];

		if ( ! empty( $info['info'] ) ) {

			$info['info']->banners = [
				'low'  => WPGB_MAP_URL . 'assets/imgs/banner.png',
				'high' => WPGB_MAP_URL . 'assets/imgs/banner.png',
			];

		}

		return $info;

	}

	/**
	 * Add card and grid demos
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string  $data   JSON demo content.
	 * @param boolean $browse Importer browse mode.
	 * @retrun string JSON demo content.
	 */
	public function add_card_demo( $data, $browse = false ) {

		$file = WPGB_MAP_PATH . 'assets/json/card.json';
		$json = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$card = json_decode( $json, true );
		$data = json_decode( $data, true );
		$data = array_merge_recursive( $data, $card );
		$data = wp_json_encode( $data );

		if ( $browse ) {
			return $this->add_grid_demo( $data );
		}

		return $data;

	}

	/**
	 * Add grid demo
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string  $data   JSON demo content.
	 * @param boolean $browse Importer browse mode.
	 * @retrun string JSON demo content.
	 */
	public function add_grid_demo( $data, $browse = false ) {

		$file = WPGB_MAP_PATH . 'assets/json/grid.json';
		$json = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$grid = json_decode( $json, true );
		$data = json_decode( $data, true );
		$data = array_merge_recursive( $data, $grid );

		return wp_json_encode( $data );

	}

	/**
	 * Register card string
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $registry Holds string ids to translate.
	 * @retrun array
	 */
	public function register_card_strings( $registry ) {

		return array_merge(
			$registry,
			[
				'geo_distance_text' => [],
			]
		);

	}

	/**
	 * Register facet string
	 *
	 * @since 1.1.0 Added geolocation strings
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $registry Holds string ids to translate.
	 * @retrun array
	 */
	public function register_facet_strings( $registry ) {

		return array_merge(
			$registry,
			[
				'map_pan_search_ctrl_label' => [],
				'geo_placeholder'           => [],
				'geo_locate_me_label'       => [],
				'geo_radius_label'          => [],
			]
		);

	}
}
