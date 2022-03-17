<?php
/**
 * Facet Helpers
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
 * Facet Helpers
 *
 * @class WP_Grid_Builder_Map_Facet\Includes\Facets\Helpers
 * @since 1.0.0
 */
class Helpers {

	/**
	 * Create geoJSON array from markers
	 *
	 * @access public
	 *
	 * @param array $markers Holds map markers.
	 * @param array $facet   Holds facet settings.
	 * @return array
	 */
	public function to_geojson( $markers, $facet ) {

		$icon = $this->get_geojson_icon( $facet );
		$icon = apply_filters( 'wp_grid_builder_map/marker_icon', $icon, $facet );

		$json = [
			'type'     => 'FeatureCollection',
			'features' => array_map(
				function( $marker ) use ( $icon ) {

					return [
						'type'       => 'Feature',
						'properties' => [
							'id'   => (int) $marker->id,
							'icon' => $icon,
						],
						'geometry'   => [
							'type'        => 'Point',
							'coordinates' => [
								(float) $marker->lng,
								(float) $marker->lat,
							],
						],
					];

				},
				$markers
			),
		];

		return apply_filters( 'wp_grid_builder_map/geojson', $json, $facet );

	}

	/**
	 * Get geoJSON icon
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return mixed
	 */
	public function get_geojson_icon( $facet ) {

		$settings = wp_parse_args(
			$facet['settings'],
			[
				'map_type'          => 'leaflet',
				'map_marker_icon'   => '',
				'map_marker_height' => 40,
			]
		);

		if ( 'mapbox' === $settings['map_type'] ) {
			return 'custom';
		}

		if ( empty( $settings['map_marker_icon'] ) ) {
			return '';
		}

		$height = (int) $settings['map_marker_height'];
		$width  = (int) ( $settings['map_marker_icon'][1] / $settings['map_marker_icon'][2] * $height );
		$size   = [
			'width'  => $width,
			'height' => $height,
		];

		return [
			'url'        => $settings['map_marker_icon'][0],
			'size'       => $size,
			'scaledSize' => $size,
			'anchor'     => [
				'x' => $width / 2,
				'y' => $height,
			],
			'origin'     => [
				'x' => 0,
				'y' => 0,
			],
		];

	}

	/**
	 * Get marker icon
	 *
	 * @access public
	 *
	 * @param array  $response Holds facet response.
	 * @param string $state Marker icon state.
	 * @return array
	 */
	public function get_marker_icon( $response, $state = '' ) {

		$icon_type = 'map_marker_icon';

		if ( $state ) {
			$icon_type .= '_' . $state;
		}

		if ( empty( $response['settings'][ $icon_type ] ) ) {
			return false;
		}

		return wp_get_attachment_image_src( $response['settings'][ $icon_type ], 'medium' );

	}

	/**
	 * Get default marker icon
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_default_icon() {

		return esc_url( WPGB_MAP_URL . 'assets/imgs/marker.png' );

	}

	/**
	 * Get Leaflet provider
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return mixed
	 */
	public function get_provider( $facet ) {

		if ( empty( $facet['settings']['map_leaflet_style'] ) ) {
			return '';
		}

		$providers = include WPGB_MAP_PATH . 'includes/facets/providers.php';
		$map_style = explode( '.', $facet['settings']['map_leaflet_style'] );
		$map_style = array_pad( $map_style, 2, '' );
		$provider  = ! empty( $providers[ $map_style[0] ] ) ? $map_style[0] : 'Wikimedia';
		$provider  = $this->get_variant( $providers[ $provider ], $map_style[1] );
		$provider  = $this->get_attribution( $providers, $provider );

		unset( $provider['variants'] );

		return $provider;

	}

	/**
	 * Get Leaflet provider variant
	 *
	 * @access public
	 *
	 * @param array  $provider Provider settings.
	 * @param string $variant  Provider variant name.
	 * @return array
	 */
	public function get_variant( $provider, $variant ) {

		if ( empty( $provider['variants'][ $variant ] ) ) {
			return $provider;
		}

		$variant = $provider['variants'][ $variant ];

		if ( is_string( $variant ) ) {
			$variant = [ 'options' => [ 'variant' => $variant ] ];
		}

		if ( ! empty( $variant['url'] ) ) {
			$provider['url'] = $variant['url'];
		}

		$provider['options'] = wp_parse_args( $variant['options'], $provider['options'] );

		return $provider;

	}

	/**
	 * Get Leaflet provider variant
	 *
	 * @access public
	 *
	 * @param array $providers Holds all providers.
	 * @param array $provider  Provider settings.
	 * @return array
	 */
	public function get_attribution( $providers, $provider ) {

		if ( empty( $provider['options']['attribution'] ) ) {
			return $provider;
		}

		$provider['options']['attribution'] = preg_replace_callback(
			'/{attribution.(\w*)\}/',
			function( $matches ) use ( $providers ) {

				if ( isset( $providers[ $matches[1] ] ) ) {
					return $providers[ $matches[1] ]['options']['attribution'];
				}

			},
			$provider['options']['attribution']
		);

		return $provider;

	}

	/**
	 * Get facet source type
	 *
	 * @access public
	 *
	 * @param array $facet Holds facet settings.
	 * @return mixed
	 */
	public function get_source_type( $facet ) {

		$source = 'post_type';

		if ( ! empty( $facet['field_type'] ) && 'post' !== $facet['field_type'] ) {
			$source = $facet['field_type'];
		}

		return $source;

	}
}
