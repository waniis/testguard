<?php
/**
 * Query
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
 * Query marker content
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Query
 * @since 1.0.0
 */
trait Query {

	/**
	 * Query marker content
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function query() {

		ob_start();

		do_action( 'wp_grid_builder_map/before_marker_content', $this->marker );

		switch ( $this->marker['source'] ) {
			case 'user':
				$this->query_user();
				break;
			case 'term':
				$this->query_term();
				break;
			default:
				$this->query_post();
		}

		do_action( 'wp_grid_builder_map/after_marker_content', $this->marker );

		$content = apply_filters( 'wp_grid_builder_map/marker_content', ob_get_clean(), $this->marker );

		wp_reset_postdata();

		return $content;

	}

	/**
	 * Query post
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function query_post() {

		$query = new \WP_Query(
			[
				'lang'                   => $this->marker['lang'],
				'post_type'              => 'any',
				'post__in'               => [ $this->marker['id'] ],
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'no_found_rows'          => true,
			]
		);

		if ( ! $query->have_posts() ) {
			$this->unknown_error();
		}

		while ( $query->have_posts() ) {
			include WPGB_MAP_PATH . 'includes/templates/post.php';
		}
	}

	/**
	 * Query user
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function query_user() {

		$query = new \WP_User_Query(
			[
				'number'      => 1,
				'include'     => [ $this->marker['id'] ],
				'count_total' => false,
			]
		);

		$users = $query->get_results();

		if ( empty( $users ) ) {
			$this->unknown_error();
		}

		foreach ( $users as $user ) {
			include WPGB_MAP_PATH . 'includes/templates/user.php';
		}
	}

	/**
	 * Query user
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function query_term() {

		$query = new \WP_Term_Query(
			[
				'number'                 => 1,
				'lang'                   => $this->marker['lang'],
				'include'                => [ $this->marker['id'] ],
				'update_term_meta_cache' => false,
			]
		);

		$terms = $query->terms;

		if ( empty( $terms ) ) {
			$this->unknown_error();
		}

		foreach ( $terms as $term ) {
			include WPGB_MAP_PATH . 'includes/templates/term.php';
		}
	}
}
