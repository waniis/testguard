<?php
/**
 * Async
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
 * Handle asynchonous requests
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Async
 * @since 1.0.0
 */
abstract class Async {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'wp_ajax_wpgb_map_facet_tooltip', [ $this, 'maybe_handle' ] );
		add_action( 'wp_ajax_nopriv_wpgb_map_facet_tooltip', [ $this, 'maybe_handle' ] );

	}

	/**
	 * Send response
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param boolean $success Success state.
	 * @param string  $message Holds message for backend.
	 * @param string  $content Holds content for backend.
	 */
	protected function send_response( $success = true, $message = '', $content = '' ) {

		wp_send_json(
			[
				'success' => (bool) $success,
				'message' => wp_strip_all_tags( $message ),
				'content' => $content,
			]
		);

	}

	/**
	 * Handle unknown errors
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function unknown_error() {

		$this->send_response(
			false,
			__( 'Sorry, an unknown error occurred.', 'wpgb-map-facet' )
		);

	}

	/**
	 * Maybe handle request
	 *
	 * Everyone can query and display marker content.
	 * So, there isn't any user capability check.
	 * And, there isn't any nonce check (because of the GET request nature) to prevent issues with caching plugins.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function maybe_handle() {

		$this->normalize();

		if (
			empty( $this->marker['id'] ) ||
			empty( $this->marker['source'] )
		) {
			$this->unknown_error();
		}

		$this->sanitize();
		$this->send_response( true, '', $this->query() );

	}

	/**
	 * Normalise data
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function normalize() {

		$this->marker = wp_parse_args(
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_unslash( $_GET ),
			[
				'id'     => '',
				'lang'   => '',
				'source' => '',
			]
		);

	}

	/**
	 * Sanitize data
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function sanitize() {

		$this->marker = [
			'id'     => (int) $this->marker['id'],
			'lang'   => sanitize_text_field( $this->marker['lang'] ),
			'source' => sanitize_text_field( $this->marker['source'] ),
		];

	}

	/**
	 * Handle query request
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	abstract protected function query();
}
