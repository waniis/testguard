<?php
/**
 * Controls fields
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
		'id'                => 'map_controls_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Controls', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'map_zoom_ctrl',
				'type'    => 'toggle',
				'label'   => __( 'Zoom', 'wpgb-map-facet' ),
				'default' => true,
			],
			[
				'id'                => 'map_scale_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Scale', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => 'IN',
						'value'   => [ 'google', 'mapbox' ],
					],
				],
			],
			[
				'id'                => 'map_fullscreen_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Fullscreen', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => 'IN',
						'value'   => [ 'google', 'mapbox' ],
					],
				],
			],
			[
				'id'                => 'map_rotate_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Rotate', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'google',
					],
				],
			],
			[
				'id'                => 'map_type_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Map Type', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'google',
					],
				],
			],
			[
				'id'                => 'map_streetview_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Street View', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'google',
					],
				],
			],
			[
				'id'                => 'map_geo_ctrl',
				'type'              => 'toggle',
				'label'             => __( 'Geolocate', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					[
						'field'   => 'map_type',
						'compare' => '===',
						'value'   => 'mapbox',
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
		'id'                => 'geo_autolocate_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'User\'s Location', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'geo_locate_me',
				'type'    => 'toggle',
				'label'   => __( 'Locate Me Button', 'wpgb-map-facet' ),
				'tooltip' => __( 'Display a button in the search field to locate the user.', 'wpgb-map-facet' ),
				'default' => true,
			],
			[
				'id'                => 'geo_locate_me_label',
				'type'              => 'text',
				'label'             => __( 'Button Aria Label', 'wpgb-map-facet' ),
				'default'           => __( 'Locate Me', 'wpgb-map-facet' ),
				'tooltip'           => __( 'Message used to provide the label to any assistive technologies.', 'wpgb-map-facet' ),
				'width'             => 380,
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'geo_locate_me',
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
	[
		'id'                => 'geo_radius_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Search Radius', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'geo_radius_control',
				'type'    => 'toggle',
				'label'   => __( 'Radius Control', 'wpgb-map-facet' ),
				'tooltip' => __( 'Display a number field below the search field to allow the user to adjust the search radius.', 'wpgb-map-facet' ),
				'default' => true,
			],
			[
				'id'                => 'geo_radius_label',
				'type'              => 'text',
				'label'             => __( 'Radius Label', 'wpgb-map-facet' ),
				'default'           => __( 'Show results within', 'wpgb-map-facet' ),
				'width'             => 380,
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'geo_radius_control',
						'compare' => '==',
						'value'   => 1,
					],
				],
			],
			[
				'id'      => 'geo_radius_unit',
				'type'    => 'radio',
				'label'   => __( 'Radius Unit', 'wpgb-map-facet' ),
				'search'  => true,
				'options' =>
				[
					'km' => __( 'Kilometer', 'wpgb-map-facet' ),
					'mi' => __( 'Mile', 'wpgb-map-facet' ),
				],
				'default' => 'km',
			],
			[
				'id'      => 'geo_radius_def',
				'type'    => 'number',
				'label'   => __( 'Default Radius', 'wpgb-map-facet' ),
				'default' => 25,
				'min'     => 0,
				'max'     => 99999,
				'width'   => 68,
			],
			[
				'id'                => 'geo_radius_min',
				'type'              => 'number',
				'label'             => __( 'Min Radius', 'wpgb-map-facet' ),
				'default'           => 1,
				'min'               => 0.001,
				'max'               => 99999,
				'step'              => 0.001,
				'width'             => 68,
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'geo_radius_control',
						'compare' => '==',
						'value'   => 1,
					],
				],
			],
			[
				'id'                => 'geo_radius_max',
				'type'              => 'number',
				'label'             => __( 'Max Radius', 'wpgb-map-facet' ),
				'default'           => 150,
				'min'               => 0.001,
				'max'               => 99999,
				'step'              => 0.001,
				'width'             => 68,
				'conditional_logic' => [
					'relation' => 'AND',
					[
						'field'   => 'geo_radius_control',
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
