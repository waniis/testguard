<?php
/**
 * Appearance fields
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = [];
$providers = include WPGB_MAP_PATH . 'includes/facets/providers.php';

foreach ( $providers as $provider => $args ) {

	$options[ $provider ] = $provider;

	if ( ! empty( $args['variants'] ) ) {

		foreach ( $args['variants'] as $variant => $atts ) {
			$options[ $provider . '.' . $variant ] = $provider . ' ' . $variant;
		}
	}
}

natcasesort( $options );

return [
	[
		'id'                => 'map_appearance_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Appearance', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'                => 'map_google_style',
				'type'              => 'select',
				'label'             => __( 'Map Style', 'wpgb-map-facet' ),
				'search'            => true,
				'options'           =>
				[
					'roadmap'   => __( 'Roadmap', 'wpgb-map-facet' ),
					'satellite' => __( 'Satellite', 'wpgb-map-facet' ),
					'hybrid'    => __( 'Hybrid', 'wpgb-map-facet' ),
					'terrain'   => __( 'Terrain', 'wpgb-map-facet' ),
				],
				'default'           => 'roadmap',
				'width'             => 380,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'google',
					],
				],
			],
			[
				'id'                => 'map_mapbox_style',
				'type'              => 'select',
				'label'             => __( 'Map Style', 'wpgb-map-facet' ),
				'width'             => 380,
				'default'           => 'mapbox.streets',
				'options'           => array_merge(
					apply_filters(
						'wp_grid_builder_map/mapbox_styles',
						[
							'mapbox://styles/mapbox/streets-v11'          => __( 'Street', 'wpgb-map-facet' ),
							'mapbox://styles/mapbox/light-v10'            => __( 'Light', 'wpgb-map-facet' ),
							'mapbox://styles/mapbox/dark-v10'             => __( 'Dark', 'wpgb-map-facet' ),
							'mapbox://styles/mapbox/outdoors-v9'          => __( 'Outdoors', 'wpgb-map-facet' ),
							'mapbox://styles/mapbox/satellite-streets-v9' => __( 'Satellite', 'wpgb-map-facet' ),
						]
					),
					[ 'custom' => __( 'Custom', 'wpgb-map-facet' ) ]
				),
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'mapbox',
					],
				],
			],
			[
				'id'                => 'map_mapbox_style_url',
				'type'              => 'text',
				'label'             => __( 'Map Custom Style', 'wpgb-map-facet' ),
				'width'             => 380,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'mapbox',
					],
					[
						'field'   => 'map_mapbox_style',
						'compare' => '===',
						'value'   => 'custom',
					],
				],
			],
			[
				'id'                => 'map_leaflet_style',
				'type'              => 'select',
				'label'             => __( 'Map Style', 'wpgb-map-facet' ),
				'search'            => true,
				'options'           => $options,
				'default'           => 'Wikimedia',
				'width'             => 380,
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'leaflet',
					],
				],
			],
			[
				'id'          => 'map_ratio',
				'type'        => 'group',
				'label'       => __( 'Map Aspect Ratio', 'wpgb-map-facet' ),
				'separator'   => '&nbsp;:&nbsp;',
				'group_names' => true,
				'fields'      => [
					'x' => [
						'id'      => 'x',
						'type'    => 'number',
						'min'     => 1,
						'max'     => 999,
						'width'   => 64,
						'default' => 16,
					],
					'y' => [
						'id'      => 'y',
						'type'    => 'number',
						'min'     => 1,
						'max'     => 999,
						'width'   => 64,
						'default' => 9,
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
	[
		'id'                => 'geo_appearance_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Appearance', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'geo_placeholder',
				'type'    => 'text',
				'label'   => __( 'Search Placeholder', 'wpgb-map-facet' ),
				'default' => __( 'Enter a location', 'wpgb-map-facet' ),
				'width'   => 380,
			],
			[
				'id'      => 'geo_location_circle',
				'type'    => 'toggle',
				'label'   => __( 'Display Searched Area', 'wpgb-map-facet' ),
				'tooltip' => __( 'Draw a circle on the map to visualize the searched area.', 'wpgb-map-facet' ),
				'default' => true,
			],
			[
				'id'                => 'geo_circle_color',
				'type'              => 'color',
				'label'             => __( 'Searched Area Color', 'wpgb-map-facet' ),
				'default'           => 'rgb(54, 138, 252)',
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'geo_location_circle',
						'compare' => '==',
						'value'   => 1,
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
					'value'   => 'geolocation',
				],
			],
		],
	],
];
