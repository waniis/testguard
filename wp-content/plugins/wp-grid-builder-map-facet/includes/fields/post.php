<?php
/**
 * Coordinates fields
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
	'id'     => 'map_coordinates_section',
	'tab'    => 'map_coordinates',
	'type'   => 'section',
	'title'  => __( 'Coordinates', 'wpgb-map-facet' ),
	'fields' => [
		[
			'id'    => 'map_lat',
			'type'  => 'text',
			'label' => __( 'Latitude', 'wpgb-map-facet' ),
			'width' => 380,
		],
		[
			'id'    => 'map_lng',
			'type'  => 'text',
			'label' => __( 'Longitude', 'wpgb-map-facet' ),
			'width' => 380,
		],
	],
];
