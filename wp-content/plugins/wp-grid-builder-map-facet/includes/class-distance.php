<?php
/**
 * Distance
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
 * Get distance
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Distance
 * @since 1.1.3
 */
class Distance {

	/**
	 * Constructor
	 *
	 * @since 1.1.3
	 * @access public
	 */
	public function __construct() {

		add_shortcode( 'wpgb_geo_distance', [ $this, 'get_distance' ] );

	}

	/**
	 * Process shortcode
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $atts Hold shortcode attributes.
	 * @return string|float
	 */
	public function get_distance( $atts ) {

		global $post;

		$atts = wp_parse_args(
			$atts,
			[
				'id'                  => is_object( $post ) ? $post->ID : 0,
				'unit'                => 'km',
				'decimal_places'      => 0,
				'decimal_separator'   => '.',
				'thousands_separator' => '',
			]
		);

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$distance = $this->calulate_distance( $atts );

		if ( '' === $distance ) {
			return '';
		}

		return $this->format_distance( $distance, $atts );

	}

	/**
	 * Format distance value
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param float $value Distance value.
	 * @param array $args  Hold shortcode attributes.
	 * @return float
	 */
	public function format_distance( $value, $args ) {

		return number_format(
			(float) $value,
			$args['decimal_places'],
			$args['decimal_separator'],
			$args['thousands_separator']
		);

	}

	/**
	 * Calculate distance from coordinates
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $atts Hold shortcode attributes.
	 * @return string
	 */
	public function calulate_distance( $atts ) {

		if ( ! wpgb_has_selected_facets() ) {
			return '';
		}

		$params = wpgb_get_url_search_params();
		$slug   = $this->get_slug( array_keys( $params ) );

		if ( empty( $slug ) || count( $params[ $slug ] ) < 3 ) {
			return '';
		}

		$coordinates = $this->get_coordinates( $atts['id'], $slug );

		if ( empty( $coordinates ) ) {
			return '';
		}

		$radius = 'mi' === $atts['unit'] ? 3959 : 6371;
		$radian = $this->get_radian(
			$params[ $slug ][0],
			$params[ $slug ][1],
			$coordinates->lat,
			$coordinates->lng
		);

		return $radian * $radius;

	}

	/**
	 * Get dregrees from coordinates.
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param integer $object Object ID.
	 * @param string  $slug   Facet slug.
	 * @return object
	 */
	public function get_coordinates( $object, $slug ) {

		global $wpdb;

		return current(
			$wpdb->get_results(
				$wpdb->prepare(
					"SELECT facet_value as lat, facet_name as lng
					FROM {$wpdb->prefix}wpgb_index
					WHERE slug = %s
					AND object_id = %d",
					$slug,
					$object
				)
			)
		);

	}

	/**
	 * Get radian from coordinates.
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param float $lat1 Latitude of start point in [deg decimal].
	 * @param float $lng1 Longitude of start point in [deg decimal].
	 * @param float $lat2 Latitude of target  point in [deg decimal].
	 * @param float $lng2 Longitude of target  point in [deg decimal].
	 * @return float
	 */
	public function get_radian( $lat1, $lng1, $lat2, $lng2 ) {

		$lat1 = deg2rad( $lat1 );
		$lng1 = deg2rad( $lng1 );
		$lat2 = deg2rad( $lat2 );
		$lng2 = deg2rad( $lng2 );

		$lat_delta = $lat2 - $lat1;
		$lgn_delta = $lng2 - $lng1;

		return 2 * asin( sqrt( pow( sin( $lat_delta / 2 ), 2 ) + cos( $lat1 ) * cos( $lat2 ) * pow( sin( $lgn_delta / 2 ), 2 ) ) );

	}

	/**
	 * Get current Geolocation facet slug
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $slugs Holds selected facet slugs.
	 * @return string
	 */
	public function get_slug( $slugs ) {

		return current( array_intersect( $this->get_slugs(), $slugs ) );

	}

	/**
	 * Get all Geolocation facet slugs
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @return array
	 */
	public function get_slugs() {

		global $wpdb;

		if ( isset( $this->slugs ) ) {
			return $this->slugs;
		}

		$this->slugs = $wpdb->get_col(
			"SELECT slug FROM {$wpdb->prefix}wpgb_facets
			WHERE type = 'geolocation'"
		);

		return $this->slugs;

	}
}
