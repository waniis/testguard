<?php
/**
 * Layers fields
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
		'id'                => 'map_layers_section',
		'tab'               => 'behaviour',
		'type'              => 'section',
		'title'             => __( 'Layers', 'wpgb-map-facet' ),
		'fields'            => [
			[
				'id'    => 'map_poi',
				'type'  => 'toggle',
				'label' => __( 'Points of Interest', 'wpgb-map-facet' ),
			],
			[
				'id'    => 'map_transit',
				'type'  => 'toggle',
				'label' => __( 'Transit', 'wpgb-map-facet' ),
			],
			[
				'id'    => 'map_traffic',
				'type'  => 'toggle',
				'label' => __( 'Traffic', 'wpgb-map-facet' ),
			],
			[
				'id'    => 'map_bicycling',
				'type'  => 'toggle',
				'label' => __( 'Bicycling', 'wpgb-map-facet' ),
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
				[
					'field'   => 'map_type',
					'compare' => '===',
					'value'   => 'google',
				],
			],
		],
	],
];
