<?php
/**
 * Positions fields
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
	[
		'id'                => 'map_coordinates_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Coordinates', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'map_lat',
				'type'    => 'number',
				'label'   => __( 'Default Latitude', 'wpgb-map-facet' ),
				'step'    => 0.000001,
				'min'     => -180,
				'max'     => 180,
				'default' => 0,
				'width'   => 100,
			],
			[
				'id'      => 'map_lng',
				'type'    => 'number',
				'label'   => __( 'Default Longitude', 'wpgb-map-facet' ),
				'step'    => 0.000001,
				'min'     => -180,
				'max'     => 180,
				'default' => 0,
				'width'   => 100,
			],
			[
				'id'      => 'map_zoom',
				'type'    => 'slider',
				'label'   => __( 'Default Zoom', 'wpgb-map-facet' ),
				'min'     => 0,
				'max'     => 20,
				'default' => 2,
			],
			[
				'id'      => 'map_min_zoom',
				'type'    => 'slider',
				'label'   => __( 'Minimum Zoom', 'wpgb-map-facet' ),
				'min'     => 0,
				'max'     => 20,
				'default' => 0,
			],
			[
				'id'      => 'map_max_zoom',
				'type'    => 'slider',
				'label'   => __( 'Maximum Zoom', 'wpgb-map-facet' ),
				'min'     => 0,
				'max'     => 20,
				'default' => 20,
			],
		],
		'conditional_logic' => [
			'relation' => 'AND',
			[
				[
					'field'   => 'action',
					'compare' => '===',
					'value'   => 'filter',
				],
				[
					'field'   => 'filter_type',
					'compare' => '===',
					'value'   => 'map',
				],
			],
		],
	],
];
