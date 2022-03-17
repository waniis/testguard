<?php
/**
 * Sort content
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
 * Handle facet settings
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Sort
 * @since 1.1.3
 */
final class Sort {

	/**
	 * Constructor
	 *
	 * @since 1.1.3
	 * @access public
	 */
	public function __construct() {

		add_filter( 'wp_grid_builder/facet/sort_options', [ $this, 'options' ] );
		add_filter( 'wp_grid_builder/facet/sort_query_vars', [ $this, 'query_vars' ] );

	}

	/**
	 * Add distance sort option
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $options Sort option from admin settings.
	 * @return array
	 */
	public function options( $options ) {

		$options[ __( 'Geolocation', 'wpgb-map-facet' ) ?: 'Geolocation' ] = [
			'geo_distance' => __( 'Distance', 'wpgb-map-facet' ),
		];

		return $options;

	}

	/**
	 * Sort by distance
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $query_vars Holds query sort variables.
	 * @return array
	 */
	public function query_vars( $query_vars ) {

		if ( empty( $query_vars['orderby'] ) || 'geo_distance' !== $query_vars['orderby'] ) {
			return $query_vars;
		}

		if ( 'post' === wpgb_get_queried_object_type() ) {
			$query_vars['orderby'] = 'post__in';
		} else {
			$query_vars['orderby'] = 'include';
		}

		return $query_vars;

	}
}
