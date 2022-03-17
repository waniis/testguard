<?php
/**
 * Date facet
 *
 * @package   WP Grid Builder
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

namespace WP_Grid_Builder\FrontEnd\Facets;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Date
 *
 * @class WP_Grid_Builder\FrontEnd\Facets\Date
 * @since 1.0.0
 */
class Date {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_filter( 'wp_grid_builder/facet/response', [ $this, 'get_settings' ], 10, 3 );

	}

	/**
	 * Filter facet response to set date settings
	 *
	 * @since 1.2.1
	 * @access public
	 *
	 * @param array $response Holds facet response.
	 * @param array $facet    Holds facet settings.
	 * @param array $items    Holds facet items.
	 * @return array
	 */
	public function get_settings( $response, $facet, $items ) {

		// Skip other facets or if already set.
		if ( 'date' !== $facet['type'] || isset( $facet['settings']['mode'] ) ) {
			return $response;
		}

		$range = $this->query_range( $facet );

		$response['settings'] = wp_parse_args(
			[
				'mode'          => $facet['date_type'],
				'locale'        => get_locale(),
				'minDate'       => substr( $range->min_date, 0, 10 ),
				'maxDate'       => substr( $range->max_date, 0, 10 ),
				'altInput'      => true,
				'altFormat'     => $facet['date_format'] ?: 'Y-m-d',
				'defaultDate'   => $facet['selected'],
				'disableMobile' => true,
			],
			$response['settings']
		);

		return $response;

	}

	/**
	 * Query date range
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return object
	 */
	public function query_range( $facet ) {

		global $wpdb;

		$where_clause = wpgb_get_filtered_where_clause( $facet, 'OR' );

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT MIN(facet_value) AS min_date, MAX(facet_value) AS max_date
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				AND facet_value != ''
				AND $where_clause", // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$facet['slug']
			)
		);

	}

	/**
	 * Render facet
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @param array $items Holds facet items.
	 * @return string Facet markup.
	 */
	public function render_facet( $facet, $items ) {

		$label  = $facet['title'] ?: __( 'Date', 'wp-grid-builder' );
		$holder = $facet['date_placeholder'] ?: __( 'Select a Date', 'wp-grid-builder' );
		$output = sprintf(
			'<div class="wpgb-date-facet">
				<label>
					<span class="wpgb-sr-only">%1$s</span>
					<input class="wpgb-input" type="text" name="%2$s" placeholder="%3$s">
					%4$s
				</label>
				%5$s
			</div>',
			esc_html( $label ),
			esc_attr( $facet['slug'] ),
			esc_attr( $holder ),
			$this->calendar_icon(),
			$this->clear_button()
		);

		return apply_filters( 'wp_grid_builder/facet/date', $output, $facet );

	}

	/**
	 * Calendar icon
	 *
	 * @since 1.2.1 Change SVG icon markup
	 * @since 1.0.0
	 * @access public
	 */
	public function calendar_icon() {

		$icon  = '<svg class="wpgb-input-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">';
		$icon .= '<path fill="none" stroke="currentColor" stroke-linecap="round" d="M4.25 3.205h15.5a3 3 0 013 3V19.75a3 3 0 01-3 3H4.25a3 3 0 01-3-3V6.205a3 3 0 013-3zM22.262 9.557H1.739 M7.114 5.65v-4.4M16.886 5.65v-4.4"></path>';
		$icon .= '</svg>';

		return $icon;

	}

	/**
	 * Clear button
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return string Clear button.
	 */
	public function clear_button() {

		$output  = '<button type="button" class="wpgb-clear-button" hidden>';
		$output .= '<span class="wpgb-sr-only">' . esc_html__( 'Clear', 'wp-grid-builder' ) . '</span>';
		$output .= '<svg viewBox="0 0 20 20" aria-hidden="true" focusable="false">';
		$output .= '<path fill="currentColor" d="M12.549 14.737l-2.572-2.958-2.57 2.958a1.2 1.2 0 01-1.812-1.574L8.387 9.95 5.594 6.737a1.2 1.2 0 01.119-1.693 1.2 1.2 0 011.693.119l2.571 2.958 2.571-2.958a1.2 1.2 0 011.693-.119 1.2 1.2 0 01.119 1.693L11.567 9.95l2.793 3.213a1.2 1.2 0 11-1.811 1.574z"></path>';
		$output .= '</svg>';
		$output .= '</button>';

		return $output;

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

		$values  = $facet['selected'];
		$min_val = min( $values ) ?: '';
		$max_val = max( $values ) ?: '';

		if ( '' === $min_val && '' === $max_val ) {
			return [];
		}

		if ( 'range' === $facet['date_type'] ) {

			return $wpdb->get_col(
				$wpdb->prepare(
					"SELECT DISTINCT object_id
					FROM {$wpdb->prefix}wpgb_index
					WHERE slug = %s
					AND LEFT(facet_value, 10) >= %s
					AND LEFT(facet_value, 10) <= %s",
					$facet['slug'],
					$min_val,
					$max_val
				)
			);

		}

		return $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT object_id
				FROM {$wpdb->prefix}wpgb_index
				WHERE slug = %s
				AND LEFT(facet_value, 10) = %s",
				$facet['slug'],
				$min_val
			)
		);

	}
}
