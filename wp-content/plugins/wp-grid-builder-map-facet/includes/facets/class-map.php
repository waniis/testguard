<?php
/**
 * Map facet
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
 * Map Facet class
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Facets\Map
 * @since 1.0.0
 */
class Map extends Helpers {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		add_filter( 'wp_grid_builder/facet/response', [ $this, 'filter_response' ], 10, 3 );

	}

	/**
	 * Filter facet response to set geoJSON and settings
	 *
	 * @access public
	 *
	 * @param array $response Holds facet response.
	 * @param array $facet    Holds facet settings.
	 * @param array $items    Holds facet items.
	 * @return array
	 */
	public function filter_response( $response, $facet, $items ) {

		if ( 'map' !== $facet['type'] || isset( $response['bounds'] ) ) {
			return $response;
		}

		$markers = $this->query_markers( $facet );

		$response['settings']['map_marker_icon_hover'] = $this->get_marker_icon( $response, 'hover' );
		$response['settings']['map_default_icon'] = $this->get_default_icon( $response );
		$response['settings']['map_marker_icon'] = $this->get_marker_icon( $response );
		$response['settings']['map_leaflet_style'] = $this->get_provider( $response );
		$response['settings']['source'] = $this->get_source_type( $facet );
		$response['geoJSON'] = $this->to_geojson( $markers, $response );
		$response['bounds'] = $this->query_bounds( $markers, $facet );

		return $response;

	}

	/**
	 * Query min and max marker bounds if no markers, no selected map values (bounds) and no default lat/lng
	 *
	 * @access public
	 *
	 * @param array $markers Holds map markers.
	 * @param array $facet   Holds facet settings.
	 * @return array
	 */
	public function query_bounds( $markers, $facet ) {

		global $wpdb;

		// We only get bounds if no markers or lat/lng set.
		if (
			! empty( $markers ) ||
			! empty( $facet['selected'] ) ||
			(
				! empty( $facet['settings']['map_lat'] ) &&
				! empty( $facet['settings']['map_lng'] )
			)
		) {
			return [];
		}

		$where_clause = wpgb_get_unfiltered_where_clause();

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT
				MIN(facet_value) AS min_lat,
				MAX(facet_value) AS max_lat,
				MIN(facet_name) AS min_lng,
				MAX(facet_name) AS max_lng
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				AND $where_clause", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$facet['slug']
			)
		);

	}

	/**
	 * Query map markers
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return array Holds map markers.
	 */
	public function query_markers( $facet ) {

		global $wpdb;

		if (
			! empty( $facet['settings']['map_limit_results'] ) &&
			'page' === $facet['settings']['map_limit_results']
		) {

			$object_ids   = wpgb_get_queried_object_ids();
			$object_ids   = array_map( 'intval', $object_ids ) ?: [ 0 ];
			$where_clause = ' object_id IN (' . implode( ',', $object_ids ) . ')';

		} else {
			$where_clause = wpgb_get_where_clause( $facet );
		}

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT facet_value AS lat, facet_name AS lng, object_id AS id
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				AND $where_clause", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$facet['slug']
			)
		);

	}

	/**
	 * Render facet choices
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 * @return string Facet markup.
	 */
	public function render_facet( $facet, $items ) {

		$output  = $this->render_map( $facet );
		$output .= $this->render_checkbox( $facet );

		return apply_filters( 'wp_grid_builder/facet/map', $output, $facet );

	}

	/**
	 * Map holder
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return string Map markup.
	 */
	public function render_map( $facet ) {

		$x = ! empty( $facet['map_ratio']['x'] ) ? $facet['map_ratio']['x'] : 16;
		$y = ! empty( $facet['map_ratio']['y'] ) ? $facet['map_ratio']['y'] : 4;

		return sprintf(
			'<div class="wpgb-map-facet" style="padding-bottom:%g%%"></div>',
			esc_attr( $y / $x * 100 )
		);

	}

	/**
	 * Pan to search checkbox
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return string Checkbox markup.
	 */
	public function render_checkbox( $facet ) {

		if ( empty( $facet['map_pan_search_ctrl'] ) ) {
			return '';
		}

		$value = ! empty( $facet['map_filtering'] ) ? $facet['map_filtering'] : false;
		$label = ! empty( $facet['map_pan_search_ctrl_label'] ) ? $facet['map_pan_search_ctrl_label'] : __( 'Search as I move the map', 'wpgb-map-facet' );

		return sprintf(
			'<label class="wpgb-map-pan-to-search">
				<input type="checkbox">
				<span class="wpgb-checkbox-control"></span>
				<span class="wpgb-map-pan-label">%2$s</span>
			</label>',
			checked( true, $value, false ),
			esc_html( $label )
		);

	}

	/**
	 * Query object ids (post, user, term) for selected facet values
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return array Holds queried facet object ids.
	 */
	public function query_objects( $facet ) {

		global $wpdb;

		if ( count( $facet['selected'] ) < 4 ) {
			return;
		}

		$swlat = $facet['selected'][0];
		$swlng = $facet['selected'][1];
		$nelat = $facet['selected'][2];
		$nelng = $facet['selected'][3];

		$and_clause = 'AND facet_value BETWEEN %f AND %f AND (
			facet_name BETWEEN %f AND 180 OR
			facet_name BETWEEN -180 AND %f
		)';

		if ( (float) $swlng < (float) $nelng ) {

			$and_clause = 'AND facet_value BETWEEN %f AND %f AND (
				facet_name BETWEEN %f AND %f
			)';

		}

		return $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT object_id
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				$and_clause", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$facet['slug'],
				$swlat,
				$nelat,
				$swlng,
				$nelng
			)
		);

	}
}
