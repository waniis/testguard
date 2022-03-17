<?php
/**
 * Block
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
 * Register builder block
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Block
 * @since 1.1.3
 */
final class Block extends Distance {

	/**
	 * Holds default block settings
	 *
	 * @since 1.1.3
	 * @access protected
	 * @var array
	 */
	public $defaults = [
		'geo_distance_text'                => '[distance]km',
		'geo_distance_unit'                => 'km',
		'geo_distance_decimal_places'      => 0,
		'geo_distance_decimal_separator'   => '.',
		'geo_distance_thousands_separator' => '',
	];

	/**
	 * Constructor
	 *
	 * @since 1.1.3
	 * @access public
	 */
	public function __construct() {

		parent::__construct();

		add_filter( 'wp_grid_builder/blocks', [ $this, 'register_block' ] );
		add_filter( 'wp_grid_builder/block/sources', [ $this, 'register_source' ] );
		add_filter( 'wp_grid_builder/settings/block_fields', [ $this, 'register_fields' ] );
		add_filter( 'wp_grid_builder/builder/register_scripts', [ $this, 'register_script' ] );

	}

	/**
	 * Registrer builder blocks
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $blocks Holds custom blocks.
	 * @return array
	 */
	public function register_block( $blocks ) {

		$blocks['geo_distance'] = [
			'name'            => esc_html__( 'Geo Distance', 'wpgb-map-facet' ),
			'icon'            => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-geolocation-large-icon',
			'settings'        => [
				'content' => [
					'source'    => 'map_block',
					'map_block' => 'geo_distance',
				],
			],
			'render_callback' => [ $this, 'render_block' ],
		];

		return $blocks;

	}

	/**
	 * Registrer block source
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $sources Holds builder block sources.
	 * @return array
	 */
	public function register_source( $sources ) {

		$sources['map_block'] = esc_html__( 'Geo Distance', 'wpgb-map-facet' );

		return $sources;

	}

	/**
	 * Registrer builder fields
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $fields Holds builder block fields.
	 * @return array
	 */
	public function register_fields( $fields ) {

		$block = include WPGB_MAP_PATH . 'includes/fields/block.php';

		return array_merge(
			$fields,
			array_map(
				function( $field ) {

					if ( isset( $this->defaults[ $field['id'] ] ) ) {
						$field['value'] = $this->defaults[ $field['id'] ];
					}

					return $field;

				},
				$block
			)
		);

	}

	/**
	 * Render distance block course progress in percent
	 *
	 * @since 1.1.3
	 *
	 * @param array $block  Holds block args.
	 * @param array $action Holds action args.
	 */
	public function render_block( $block = [], $action = [] ) {

		$settings = wp_parse_args( $block, $this->defaults );
		$distance = [
			'id'                  => wpgb_get_the_id(),
			'unit'                => $settings['geo_distance_unit'],
			'decimal_places'      => $settings['geo_distance_decimal_places'],
			'decimal_separator'   => $settings['geo_distance_decimal_separator'],
			'thousands_separator' => $settings['geo_distance_thousands_separator'],
		];

		if ( wpgb_is_overview() ) {
			$distance = $this->format_distance( 25, $distance );
		} else {
			$distance = $this->get_distance( $distance );
		}

		if ( empty( $distance ) ) {
			return;
		}

		wpgb_block_start( $block, $action );
			echo wp_kses_post( str_replace( '[distance]', $distance, $settings['geo_distance_text'] ) );
		wpgb_block_end( $block, $action );

	}

	/**
	 * Register block script
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $scripts Holds script to register.
	 * @return array
	 */
	public function register_script( $scripts ) {

		$scripts[] = [
			'handle'  => 'wpgb-map-facet',
			'source'  => WPGB_MAP_URL . 'assets/js/block.js',
			'version' => WPGB_MAP_VERSION,
		];

		return $scripts;

	}
}
