<?php
/**
 * Deprecated functions
 *
 * @package   WP Grid Builder
 * @author    Loïc Blascos
 * @copyright 2019-2021 Loïc Blascos
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get total number of posts from unfiltered query
 *
 * @since 1.0.0
 * @deprecated 1.1.5
 *
 * @return integer
 */
function wpgb_get_found_posts() {

	_deprecated_function( __FUNCTION__, '1.1.5', 'wpgb_get_found_objects' );

	return wpgb_get_found_objects();

}

/**
 * Build order clause
 *
 * @since 1.0.0
 * @deprecated 1.1.6
 *
 * @param  array $facet Holds facet settings.
 * @return string SQL orderby clause
 */
function wpgb_get_order_clause( $facet = [] ) {

	_deprecated_function( __FUNCTION__, '1.1.6', 'wpgb_get_orderby_clause' );

	return wpgb_get_orderby_clause( $facet );

}

/**
 * Get plugin options
 *
 * @since 1.0.0
 * @deprecated 1.4.0
 *
 * @return mixed
 */
function wpgb_get_global_settings() {

	_deprecated_function( __FUNCTION__, '1.4.0', 'wpgb_get_options' );

	return wpgb_get_options();

}
