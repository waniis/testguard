<?php

/* Helper - Get Product IDs on sale */
function wctd_get_product_ids_on_sale() {
	//The WooCommerce ones...
	$product_ids_on_sale = wc_get_product_ids_on_sale();
	//Ours
	$term_ids = array();
	$discount_rules = WC_Taxonomy_Discounts_Webdados()->get_discount_rules();
	foreach( $discount_rules as $priority => $terms ) {
		foreach ( $terms as $term_id => $rules ) {
			foreach ( $rules as $rule ) {
				if ( WC_Taxonomy_Discounts_Webdados()->valid_rule_user_role( $rule ) && WC_Taxonomy_Discounts_Webdados()->valid_rule_date( $rule ) && isset( $rule['type'] ) ) {
					$term_ids[] = $rule['term_id'];
				}
			}
		}
	}
	$term_ids = array_unique( $term_ids);
	if ( count( $term_ids ) > 0 ) {
		//This is not very WooCommerce 3.0 CRUD functions compatible...
		global $wpdb;
		$sql="
			SELECT post.ID, post.post_parent
			FROM `$wpdb->posts` AS post, `$wpdb->term_relationships` AS term_relationships
			WHERE
				post.post_type IN ( 'product', 'product_variation' )
				AND
				post.post_status = 'publish'
				AND
				term_relationships.term_taxonomy_id IN (".implode( ',', $term_ids).")
				AND
				post.ID=term_relationships.object_id
			GROUP BY post.ID;
		";
		$on_sale_posts = $wpdb->get_results( $sql );
		$product_ids_on_sale_1 = array_unique( array_map( 'absint', array_merge( wp_list_pluck( $on_sale_posts, 'ID' ), array_diff( wp_list_pluck( $on_sale_posts, 'post_parent' ), array( 0 ) ) ) ) );
		$product_ids_on_sale = array_unique( array_merge( $product_ids_on_sale, $product_ids_on_sale_1 ) );
	}
	return $product_ids_on_sale;
}

/* Helper - Get product (or variation) current/discounted price */
function wctd_get_product_current_price( $product, $qty = 1 ) {
	if ( is_int( $product ) ) {
		$product = wc_get_product( $product );
	}
	if ( is_object( $product ) ) {
		return WC_Taxonomy_Discounts_Webdados()->on_get_price( floatval( WC_Taxonomy_Discounts_Webdados()->wc3 ? $product->get_price() : $product->price ), $product, true, $qty );
	} else {
		return false;
	}
}

/* Helper - Get applied rule */
function wctd_get_product_applied_rule( $product ) {
	$found = false;
	$discount_rules = WC_Taxonomy_Discounts_Webdados()->get_discount_rules();
	if ( count( $discount_rules ) ) {
		if ( is_int( $product ) ) $product = wc_get_product( $product );
		if ( $product ) {
			$product_id = $product->get_id();
			foreach( $discount_rules as $priority => $terms ) {
				foreach ( $terms as $term_id => $rules ) {
					foreach ( $rules as $rule_key => $rule ) {
						if ( WC_Taxonomy_Discounts_Webdados()->valid_rule_user_role( $rule ) && WC_Taxonomy_Discounts_Webdados()->valid_rule_date( $rule ) && isset( $rule['type'] ) && has_term( $term_id, $rule['taxonomy'], $product_id ) ) {
							return $rule;
						}
					}
				}
			}
		}
	}
	return false;
}