<?php
/**
 * Block fields
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	// map_block.
	[
		'id'                => 'map_block',
		'tab'               => 'content',
		'type'              => 'select',
		'label'             => esc_html__( 'Map Blocks', 'wpgb-map-facet' ),
		'options'           => [
			'geo_distance' => esc_html__( 'Geolocation Distance', 'wpgb-map-facet' ),
		],
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => '_map_block',
			],
		],
	],
	// geo_distance_text.
	[
		'id'                => 'geo_distance_text',
		'tab'               => 'content',
		'type'              => 'text',
		'label'             => esc_html__( 'Distance Text', 'wpgb-map-facet' ),
		'placeholder'       => '[distance]km',
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => 'map_block',
			],
		],
	],
	// geo_distance_unit.
	[
		'id'                => 'geo_distance_unit',
		'tab'               => 'content',
		'type'              => 'radio',
		'label'             => esc_html__( 'Distance Unit', 'wpgb-map-facet' ),
		'options'           => [
			'km' => __( 'Kilometer', 'wpgb-map-facet' ),
			'mi' => __( 'Mile', 'wpgb-map-facet' ),
		],
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => 'map_block',
			],
		],
	],
	// geo_distance_decimal_places.
	[
		'id'                => 'geo_distance_decimal_places',
		'tab'               => 'content',
		'type'              => 'number',
		'label'             => esc_html__( 'Decimal Places', 'wpgb-map-facet' ),
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => 'map_block',
			],
		],
	],
	// geo_distance_decimal_separator.
	[
		'id'                => 'geo_distance_decimal_separator',
		'tab'               => 'content',
		'type'              => 'text',
		'label'             => esc_html__( 'Decimal Separator', 'wpgb-map-facet' ),
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => 'map_block',
			],
		],
	],
	// geo_distance_thousands_separator.
	[
		'id'                => 'geo_distance_thousands_separator',
		'tab'               => 'content',
		'type'              => 'text',
		'label'             => esc_html__( 'Thousands Separator', 'wpgb-map-facet' ),
		'white_spaces'      => true,
		'conditional_logic' => [
			[
				'field'   => 'source',
				'compare' => '===',
				'value'   => 'map_block',
			],
		],
	],
];
