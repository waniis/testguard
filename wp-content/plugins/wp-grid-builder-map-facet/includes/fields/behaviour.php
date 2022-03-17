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
		'id'                => 'map_behaviour_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Behaviour', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'      => 'map_dragging',
				'type'    => 'toggle',
				'label'   => __( 'Drag to Pan', 'wpgb-map-facet' ),
				'default' => true,
			],
			[
				'id'                => 'map_scrolling',
				'type'              => 'toggle',
				'label'             => __( 'Scroll to Zoom', 'wpgb-map-facet' ),
				'default'           => true,
				'conditional_logic' => [
					'relation' => 'OR',
					[
						'field'   => 'map_type',
						'compare' => '!==',
						'value'   => 'google',
					],
					[
						[
							'field'   => 'map_type',
							'compare' => '===',
							'value'   => 'google',
						],
						[
							'field'   => 'map_dragging',
							'compare' => '!==',
							'value'   => '0',
						],
					],
				],
			],
			[
				'id'      => 'map_pan_search_ctrl',
				'type'    => 'toggle',
				'label'   => __( 'Pan to Search', 'wpgb-map-facet' ),
				'tooltip' => __( 'Display an option over the map that allows user to search while moving the map.', 'wpgb-map-facet' ),
				'default' => false,
			],
			[
				'id'                => 'map_pan_search_ctrl_label',
				'type'              => 'text',
				'width'             => 380,
				'label'             => __( 'Pan to Search Label', 'wpgb-map-facet' ),
				'default'           => __( 'Search as I move the map', 'wpgb-map-facet' ),
				'placeholder'       => __( 'Search as I move the map', 'wpgb-map-facet' ),
				'conditional_logic' => [
					[
						'field'   => 'map_pan_search_ctrl',
						'compare' => '==',
						'value'   => true,
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
