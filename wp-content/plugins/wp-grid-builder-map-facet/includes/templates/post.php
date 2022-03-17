<?php
/**
 * Marker tooltip post template
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$query->the_post();

$excerpt = get_the_excerpt();

echo '<div class="wpgb-map-marker-body">';

the_title( '<h3 class="wpgb-map-marker-title">', '</h3>' );

if ( ! empty( $excerpt ) ) {

	$excerpt = wp_trim_words( $excerpt, 26, '' );
	echo '<p class="wpgb-map-marker-content">' . wp_kses_post( $excerpt ) . '</p>';

}

echo '</div>';
