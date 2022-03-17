<?php
/**
 * Facets
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
 * @class WP_Grid_Builder_Map_Facet\Includes\Facets
 * @since 1.0.0
 */
final class Facets extends Async {

	use Query;

	/**
	 * Holds all facet identifiers
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */
	protected $facets = [];

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		parent::__construct();

		add_filter( 'wp_grid_builder/facets', [ $this, 'register_facets' ] );
		add_filter( 'wp_grid_builder/custom_fields', [ $this, 'custom_field' ] );
		add_filter( 'wp_grid_builder/indexer/row', [ $this, 'index_map' ], 10, 3 );
		add_filter( 'wp_grid_builder/facet/render_args', [ $this, 'render_facet' ] );
		add_filter( 'wp_grid_builder/frontend/register_styles', [ $this, 'register_style' ] );
		add_filter( 'wp_grid_builder/frontend/register_scripts', [ $this, 'register_scripts' ] );
		add_filter( 'wp_grid_builder/frontend/enqueue_styles', [ $this, 'enqueue_assets' ] );
		add_filter( 'wp_grid_builder/frontend/enqueue_scripts', [ $this, 'enqueue_assets' ] );
		add_filter( 'wp_grid_builder/frontend/localize_script', [ $this, 'localize_script' ] );

	}

	/**
	 * Register facets (proximity facet will come later)
	 *
	 * @since 1.1.0 Added geolocation facet
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $facets Holds registered facet arguments.
	 * @return array
	 */
	public function register_facets( $facets ) {

		$facets['map'] = [
			'name'  => __( 'Map', 'wpgb-map-facet' ),
			'type'  => 'filter',
			'class' => __NAMESPACE__ . '\Facets\Map',
			'icons' => [
				'large' => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-map-large-icon',
				'small' => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-map-small-icon',
			],
		];

		$facets['geolocation'] = [
			'name'  => __( 'Geolocation', 'wpgb-map-facet' ),
			'type'  => 'filter',
			'class' => __NAMESPACE__ . '\Facets\Geo',
			'icons' => [
				'large' => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-geolocation-large-icon',
				'small' => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-geolocation-small-icon',
			],
		];

		return $facets;

	}

	/**
	 * Register custom field
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $fields Holds registered custom fields.
	 * @return array
	 */
	public function custom_field( $fields ) {

		$fields['Map Facet'] = [
			'_wpgb_map_coordinates' => __( 'Map Coordinates', 'wpgb-map-facet' ),
		];

		return $fields;

	}

	/**
	 * Get all facet identifiers.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $args Holds facet args.
	 * @return array
	 */
	public function render_facet( $args ) {

		$this->facets[] = $args['id'];

		return $args;

	}

	/**
	 * Check if the page contains map or geolocation facets
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $type Fact type to check.
	 * @return boolean
	 */
	public function has_facet( $type = '' ) {

		$this->get_types();

		$has_facet = wpgb_is_gutenberg();

		if ( in_array( $type, $this->types, true ) ) {
			$has_facet = true;
		}

		return apply_filters( 'wp_grid_builder_map/has_facet', $has_facet, $type );

	}

	/**
	 * Get facet types
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_types() {

		global $wpdb;

		if ( isset( $this->types ) ) {
			return;
		}

		$this->types = [];

		if ( empty( $this->facets ) ) {
			return;
		}

		$this->facets = array_unique( $this->facets );
		$placeholders = rtrim( str_repeat( '%s,', count( $this->facets ) ), ',' );
		$this->types  = array_column(
			$wpdb->get_results(
				$wpdb->prepare(
					"SELECT type
					FROM {$wpdb->prefix}wpgb_facets
					WHERE type IN ('map','geolocation')
					AND id IN ($placeholders)", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
					$this->facets
				),
				'ARRAY_A'
			),
			'type'
		);

	}

	/**
	 * Index map fields
	 *
	 * @since 1.0.4 Allow to index any array containing lat and lng properties.
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array   $row       Holds index row of the current object id.
	 * @param integer $object_id Post, term or user id to index.
	 * @param array   $facet     Holds facet settings.
	 * @return array
	 */
	public function index_map( $row, $object_id, $facet ) {

		if ( empty( $facet['filter_type'] ) || ! in_array( $facet['filter_type'], [ 'map', 'geolocation' ], true ) ) {
			return $row;
		}

		$has_coordinates = isset(
			$row['facet_value']['lat'],
			$row['facet_name']['lng']
		);

		if ( $has_coordinates ) {

			$row['facet_value'] = $row['facet_value']['lat'];
			$row['facet_name']  = $row['facet_name']['lng'];

		}

		return $row;

	}

	/**
	 * Register facet style
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $styles Holds styles to register.
	 * @return array
	 */
	public function register_style( $styles ) {

		$styles[] = [
			'handle'  => 'wpgb-map',
			'source'  => WPGB_MAP_URL . 'assets/css/style.css',
			'version' => WPGB_MAP_VERSION,
		];

		return $styles;

	}

	/**
	 * Register facet script
	 *
	 * @since 1.1.0 Added geolocation script
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $scripts Holds scripts to register.
	 * @return array
	 */
	public function register_scripts( $scripts ) {

		$scripts[] = [
			'handle'  => 'wpgb-geo-js',
			'source'  => WPGB_MAP_URL . 'assets/js/geo.js',
			'version' => WPGB_MAP_VERSION,
		];

		$scripts[] = [
			'handle'  => 'wpgb-map-js',
			'source'  => WPGB_MAP_URL . 'assets/js/map.js',
			'version' => WPGB_MAP_VERSION,
		];

		return $scripts;

	}

	/**
	 * Enqueue assets
	 *
	 * @since 1.1.0 Added check for geolocation facet type
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $handles Holds assets handle.
	 * @return array
	 */
	public function enqueue_assets( $handles ) {

		$has_map = $this->has_facet( 'map' );
		$has_geo = $this->has_facet( 'geolocation' );

		if ( ! $has_map ) {
			unset( $handles['wpgb-map-js'] );
		}

		if ( ! $has_geo ) {
			unset( $handles['wpgb-geo-js'] );
		}

		if ( ! $has_map && ! $has_geo ) {
			unset( $handles['wpgb-map'] );
		}

		return $handles;

	}

	/**
	 * Localize facet data
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $data Holds data to localize.
	 * @return array
	 */
	public function localize_script( $data ) {

		if ( $this->has_facet( 'map' ) ) {

			$data['mapFacet'] = [
				'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
				'markers' => esc_url( WPGB_MAP_URL . 'assets/imgs/m' ),
				'vendors' => [
					[
						'type'    => 'js',
						'handle'  => 'wpgb-map',
						'source'  => esc_url( WPGB_MAP_URL . 'assets/js/vendors/leaflet.js' ),
						'version' => filemtime( WPGB_MAP_PATH . 'assets/js/vendors/leaflet.js' ),
					],
					[
						'type'    => 'css',
						'handle'  => 'wpgb-map',
						'source'  => esc_url( WPGB_MAP_URL . 'assets/css/vendors/leaflet.css' ),
						'version' => filemtime( WPGB_MAP_PATH . 'assets/css/vendors/leaflet.css' ),
					],
				],
			];

		}

		return $data;

	}
}
