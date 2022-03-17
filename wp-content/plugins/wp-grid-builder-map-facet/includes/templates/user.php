<?php
/**
 * Marker tooltip user template
 *
 * @package   WP Grid Builder - Map Facet
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$description = $user->description;

echo '<div class="wpgb-map-marker-body">';

echo '<h3 class="wpgb-map-marker-title">' . esc_html( $user->display_name ) . '</h3>';

if ( ! empty( $description ) ) {

	$description = wp_trim_words( $description, 26, '' );
	echo '<p class="wpgb-map-marker-content">' . wp_kses_post( $description ) . '</p>';

}

echo '</div>';
