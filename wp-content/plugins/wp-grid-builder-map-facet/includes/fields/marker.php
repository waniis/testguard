<?php
/**
 * Marker fields
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
		'id'                => 'map_marker_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Markers', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'map_marker_content',
				'type'    => 'toggle',
				'label'   => __( 'Marker Content', 'wpgb-map-facet' ),
				'tooltip' => __( 'Display marker content on click.', 'wpgb-map-facet' ),
				'default' => 1,
			],
			[
				'id'      => 'map_marker_cluster',
				'type'    => 'toggle',
				'label'   => __( 'Marker Clustering', 'wpgb-map-facet' ),
				'default' => 0,
			],
			[
				'id'                => 'map_cluster_size',
				'type'              => 'number',
				'label'             => __( 'Min Markers in Cluster', 'wpgb-map-facet' ),
				'min'               => 2,
				'max'               => 999999,
				'step'              => 1,
				'default'           => 2,
				'conditional_logic' => [
					[
						'field'   => 'map_marker_cluster',
						'compare' => '===',
						'value'   => '1',
					],
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'google',
					],
				],
			],
			[
				'id'                => 'map_cluster_radius',
				'type'              => 'number',
				'label'             => __( 'Cluster Radius', 'wpgb-map-facet' ),
				'tooltip'           => __( 'Radius of each cluster when clustering markers in px.', 'wpgb-map-facet' ),
				'min'               => 1,
				'max'               => 999999,
				'step'              => 1,
				'default'           => 50,
				'conditional_logic' => [
					[
						'field'   => 'map_marker_cluster',
						'compare' => '===',
						'value'   => '1',
					],
					[
						'field'   => 'map_type',
						'compare' => 'IN',
						'value'   => [ 'leaflet', 'mapbox' ],
					],
				],
			],
			[
				'id'                => 'map_cluster_max_zoom',
				'type'              => 'slider',
				'label'             => __( 'Cluster Max Zoom', 'wpgb-map-facet' ),
				'tooltip'           => __( 'Maximum zoom to cluster markers on.', 'wpgb-map-facet' ),
				'min'               => 1,
				'max'               => 20,
				'step'              => 1,
				'default'           => 14,
				'conditional_logic' => [
					[
						'field'   => 'map_marker_cluster',
						'compare' => '===',
						'value'   => '1',
					],
				],
			],
			[
				'id'    => 'map_marker_icon',
				'type'  => 'image',
				'label' => __( 'Marker Icon', 'wpgb-map-facet' ),
			],
			[
				'id'                => 'map_marker_icon_hover',
				'type'              => 'image',
				'label'             => __( 'Marker Icon Highlighted', 'wpgb-map-facet' ),
				'tooltip'           => __( 'The highlighted icon is used instead of the default icon when hovering cards in a grid.', 'wpgb-map-facet' ),
				'conditional_logic' => [
					[
						'field'   => 'map_marker_icon',
						'compare' => '!==',
						'value'   => '',
					],
				],
			],
			[
				'id'                => 'map_marker_height',
				'type'              => 'number',
				'label'             => __( 'Marker Size (px)', 'wpgb-map-facet' ),
				'default'           => 40,
				'conditional_logic' => [
					[
						'field'   => 'map_marker_icon',
						'compare' => '!==',
						'value'   => '',
					],
				],
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
