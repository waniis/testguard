<?php
/**
 * Geolocation facet
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

namespace WP_Grid_Builder_Map_Facet\Includes\Facets;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Geolocation Facet class
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Facets\Geo
 * @since 1.1.0
 */
class Geo extends Helpers {

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function __construct() {

		add_filter( 'wp_grid_builder/facet/response', [ $this, 'filter_response' ], 10, 3 );
		add_filter( 'wp_grid_builder/facet/weight', [ $this, 'facet_weight' ], 10, 2 );

	}

	/**
	 * Filter facet response to set locale
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $response Holds facet response.
	 * @param array $facet    Holds facet settings.
	 * @param array $items    Holds facet items.
	 * @return array
	 */
	public function filter_response( $response, $facet, $items ) {

		// Skip other facets or if already set.
		if ( 'geolocation' !== $facet['type'] || isset( $facet['settings']['locale'] ) ) {
			return $response;
		}

		$response['settings']['locale'] = get_locale();

		return $response;

	}

	/**
	 * Set max weight to geolocation results to order by distances (post__in/include clauses)
	 *
	 * @since 1.1.3
	 * @access public
	 *
	 * @param array $weight Facet weight.
	 * @param array $facet  Holds facet settings.
	 * @return integer
	 */
	public function facet_weight( $weight, $facet ) {

		if ( 'geolocation' === $facet['type'] && ! empty( $facet['selected'] ) ) {
			$weight = PHP_INT_MAX - 9;
		}

		return $weight;

	}

	/**
	 * Render facet input
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 * @return string Facet markup.
	 */
	public function render_facet( $facet, $items ) {

		$settings = $this->normalize( $facet['settings'] );
		$label    = $facet['title'] ?: __( 'Geolocation', 'wpgb-map-facet' );
		$output   = sprintf(
			'<div class="wpgb-geolocation-facet">
				<div class="wpgb-geolocation-input">
					<label>
						<span class="wpgb-sr-only">%1$s</span>
						<input class="wpgb-input" type="search" placeholder="%2$s" autocomplete="off">
						%3$s
					</label>
					%4$s
				</div>
				%5$s
			</div>',
			esc_html( $label ),
			esc_attr( $settings['geo_placeholder'] ),
			$this->search_icon(),
			$this->locate_button( $settings ),
			$this->radius_control( $settings )
		);

		return apply_filters( 'wp_grid_builder/facet/geolocation', $output, $facet );

	}

	/**
	 * Search icon
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @return string
	 */
	public function search_icon() {

		$output  = '<svg class="wpgb-input-icon" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false">';
		$output .= '<path fill="currentColor" d="M18.932 16.845a10.206 10.206 0 0 0 2.087-6.261A10.5 10.5 0 0 0 10.584 0a10.584 10.584 0 0 0 0 21.168 9.9 9.9 0 0 0 6.261-2.087l4.472 4.472a1.441 1.441 0 0 0 2.087 0 1.441 1.441 0 0 0 0-2.087zm-8.348 1.193a7.508 7.508 0 0 1-7.6-7.453 7.6 7.6 0 0 1 15.2 0 7.508 7.508 0 0 1-7.6 7.452z"></path>';
		$output .= '</svg>';

		return $output;

	}

	/**
	 * Locate button
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $settings Holds facet settings.
	 * @return string
	 */
	public function locate_button( $settings ) {

		if ( empty( $settings['geo_locate_me'] ) ) {
			return '';
		}

		$output  = '<button type="button" class="wpgb-locate-button" hidden>';
		$output .= '<span class="wpgb-sr-only">' . esc_html( $settings['geo_locate_me_label'] ) . '</span>';
		$output .= '<svg width="40" height="20" viewBox="0 0 24 24" aria-hidden="true" focusable="false">';
		$output .= '<path fill="currentColor" d="M24,11h-2.051C21.479,6.283,17.717,2.521,13,2.051V0h-2v2.051C6.283,2.521,2.521,6.283,2.051,11H0v2h2.051 c0.471,4.717,4.232,8.479,8.949,8.949V24h2v-2.051c4.717-0.471,8.479-4.232,8.949-8.949H24V11z M13,19.931V18h-2v1.931 C7.388,19.477,4.523,16.612,4.069,13H6v-2H4.069C4.523,7.388,7.388,4.523,11,4.069V6h2V4.069c3.612,0.453,6.477,3.319,6.931,6.931 H18v2h1.931C19.477,16.612,16.612,19.477,13,19.931z"></path>';
		$output .= '<circle fill="currentColor" cx="12" cy="12" r="2"></circle>';
		$output .= '</svg>';
		$output .= '</button>';

		return $output;

	}

	/**
	 * Radius input control
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $settings Holds facet settings.
	 * @return string
	 */
	public function radius_control( $settings ) {

		if ( empty( $settings['geo_radius_control'] ) ) {
			return '';
		}

		return sprintf(
			'<label class="wpgb-geo-radius">%1$s&nbsp;<input type="number" value="%2$g" min="%3$g" max="%4$g">&nbsp;%5$s</label>',
			esc_html( $settings['geo_radius_label'] ),
			esc_attr( $settings['geo_radius_def'] ),
			esc_attr( $settings['geo_radius_min'] ),
			esc_attr( $settings['geo_radius_max'] ),
			esc_html( $settings['geo_radius_unit'] )
		);

	}

	/**
	 * Normalize facet settings
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $settings Holds facet settings.
	 * @return array
	 */
	public function normalize( $settings ) {

		return wp_parse_args(
			$settings,
			[
				'geo_location_circle' => true,
				'geo_circle_color'    => 'rgb(54, 138, 252)',
				'geo_placeholder'     => __( 'Enter a location', 'wpgb-map-facet' ),
				'geo_locate_me'       => true,
				'geo_locate_me_label' => __( 'Locate Me', 'wpgb-map-facet' ),
				'geo_radius_control'  => true,
				'geo_radius_label'    => __( 'Show results within', 'wpgb-map-facet' ),
				'geo_radius_unit'     => 'km',
				'geo_radius_def'      => 25,
				'geo_radius_min'      => 1,
				'geo_radius_max'      => 150,
			]
		);

	}

	/**
	 * Query object ids (post, user, term) for selected facet values
	 *
	 * @since 1.1.0
	 * @access public
	 *
	 * @param array $facet      Holds facet settings.
	 * @param array $query_vars Holds query vars.
	 * @return array Holds queried facet object ids.
	 */
	public function query_objects( $facet, $query_vars = [] ) {

		global $wpdb;

		if ( count( $facet['selected'] ) < 3 ) {
			return;
		}

		// To allow ASC/DESC order from post__in/include clauses.
		$order = isset( $query_vars['order'] ) && 'DESC' === strtoupper( $query_vars['order'] ) ? 'DESC' : 'ASC';
		$unit  = ! empty( $facet['geo_radius_unit'] ) ? $facet['geo_radius_unit'] : 'km';

		return $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT object_id, ( %f * acos(
					greatest( -1, least( 1, (
						cos( radians( %f ) ) *
						cos( radians( facet_value ) ) *
						cos( radians( facet_name ) - radians( %f ) ) +
						sin( radians( %f ) ) *
						sin( radians( facet_value ) )
					) ) )
				) ) AS distance
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				HAVING distance < %f
				ORDER BY distance $order",    // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				'mi' === $unit ? 3959 : 6371, // Earth radius.
				$facet['selected'][0],        // Latitude.
				$facet['selected'][1],        // Longitude.
				$facet['selected'][0],        // Latitude.
				$facet['slug'],
				$facet['selected'][2]         // Radius.
			)
		);
	}
}
