<?php
/**
 * Facet Settings
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
 * @class WP_Grid_Builder_Map_Facet\Includes\Settings
 * @since 1.0.0
 */
final class Settings {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_filter( 'wp_grid_builder/settings/post_tabs', [ $this, 'add_post_tab' ] );
		add_filter( 'wp_grid_builder/settings/post_fields', [ $this, 'add_post_fields' ] );
		add_filter( 'wp_grid_builder/settings/facet_fields', [ $this, 'add_facet_fields' ] );
		add_filter( 'wp_grid_builder/settings/save_fields', [ $this, 'save_fields' ], 10, 3 );

	}

	/**
	 * Register post tab
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $tabs Holds post settings tabs.
	 * @return array
	 */
	public function add_post_tab( $tabs ) {

		$tabs[] = [
			'id'    => 'map_coordinates',
			'label' => __( 'Coordinates', 'wpgb-map-facet' ),
			'icon'  => WPGB_MAP_URL . 'assets/svg/sprite.svg?v=' . WPGB_MAP_VERSION . '#wpgb-pin-icon',
		];

		return $tabs;

	}

	/**
	 * Register post fields
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $fields Holds post fields.
	 * @return array
	 */
	public function add_post_fields( $fields ) {

		$fields[] = include WPGB_MAP_PATH . 'includes/fields/post.php';

		return $fields;

	}

	/**
	 * Register facet fields
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $fields Holds facet fields.
	 * @return array
	 */
	public function add_facet_fields( $fields ) {

		return array_merge(
			$fields,
			include WPGB_MAP_PATH . 'includes/fields/api.php',
			include WPGB_MAP_PATH . 'includes/fields/appearance.php',
			include WPGB_MAP_PATH . 'includes/fields/layers.php',
			include WPGB_MAP_PATH . 'includes/fields/coordinates.php',
			include WPGB_MAP_PATH . 'includes/fields/behaviour.php',
			include WPGB_MAP_PATH . 'includes/fields/controls.php',
			include WPGB_MAP_PATH . 'includes/fields/marker.php'
		);

	}

	/**
	 * Save post/term/user map fields
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array   $fields Holds field values to save.
	 * @param string  $type   Object type (post/term/user).
	 * @param integer $id     Object id.
	 * @return array
	 */
	public function save_fields( $fields, $type = '', $id = 0 ) {

		if ( ! isset( $fields['map_lng'], $fields['map_lat'] ) ) {
			return $fields;
		}

		$coordinates = [
			'lng' => $fields['map_lng'],
			'lat' => $fields['map_lat'],
		];

		update_metadata( $type, $id, '_wpgb_map_coordinates', $coordinates );
		$this->trigger_indexer( $type, $id );

		return $fields;

	}

	/**
	 * Manually trigger indexer on save in preview mode (grid settings)
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string  $type Object type (post/term/user).
	 * @param integer $id   Object id.
	 * @return array
	 */
	public function trigger_indexer( $type, $id ) {

		// For preview mode ajax popup only.
		if ( ! wp_doing_ajax() ) {
			return;
		}

		switch ( $type ) {
			case 'post':
				do_action( 'save_post', $id, get_post( $id ), true );
				break;
			case 'user':
				do_action( 'profile_update', $id, get_user_by( 'id', $id ) );
				break;
			case 'term':
				$term = get_term( $id );
				do_action( 'edited_term', $id, $term->term_taxonomy_id, $term->taxonomy );
				break;
		}
	}
}
