<?php

function chrono_get_timezone() {
	$timezone_string = get_option( 'timezone_string' );

	if ( ! empty( $timezone_string ) ) {
		return $timezone_string;
	}

	$offset  = get_option( 'gmt_offset' );
	$hours   = (int) $offset;
	$minutes = ( $offset - floor( $offset ) ) * 60;
	$offset  = sprintf( '%+03d:%02d', $hours, $minutes );

	return $offset;
}

function chrono_get_option( $key = '', $section = 'general', $default = false ) {
	return chrono_get_generic_option( 'chronopost_settings', $key, $section, $default );
}

function chrono_get_imports_option( $key = '', $section = 'general', $default = false ) {
	return chrono_get_generic_option( 'chronopost_imports', $key, $section, $default );
}

/**
 * @param        $settings
 * @param string $key
 * @param string $section
 * @param        $default
 *
 * @return string
 */
function chrono_get_generic_option( $settings, $key, $section, $default ) {
	$options = get_option( $settings, $default );
	if ( is_array( $options ) ) {
		if ( ! array_key_exists( $section, $options ) ) {
			return $default == false ? '' : $default;
		}

		if ( array_key_exists( $key, $options[ $section ] ) ) {
			return $options[ $section ][ $key ];
		}
	}

	return $default == false ? '' : $default;
}

function chrono_get_media_path() {
	return WP_CONTENT_DIR . '/uploads/chronopost/';
}

function chrono_get_media_url() {
	return WP_CONTENT_URL . '/uploads/chronopost/';
}

function chrono_get_weight_unit() {
	 return strtolower( get_option( 'woocommerce_weight_unit' ) );
}

function chrono_get_product_code_by_id( $id_method ) {
	$product_code_key         = chrono_get_option( 'enable', 'bal_option' ) == 'yes' ? 'product_code_bal' : 'product_code';
	$default_product_code_key = 'product_code';

	$chronopost_methods = get_option( 'chronopost_shipping_methods', array(), true );

	if ( array_key_exists( $id_method, $chronopost_methods ) ) {
		if ( $chronopost_methods[ $id_method ][ $product_code_key ] != false ) {
			return $chronopost_methods[ $id_method ][ $product_code_key ];
		}
	}
	return $chronopost_methods[ $id_method ][ $default_product_code_key ];
}

function chrono_get_method_settings( $id_method, $key = false ) {
	$method_settings = (array) get_option( 'woocommerce_' . $id_method . '_settings' );
	return ! $key ? (array) $method_settings : ( array_key_exists( $key, $method_settings ) ? $method_settings[ $key ] : '' );
}

function chrono_get_tracking_url( $skybill_number = false, $shipping_method_id = false ) {
	if ( $skybill_number && $shipping_method_id ) {
		return str_replace( '{tracking_number}', $skybill_number, chrono_get_method_settings( $shipping_method_id, 'tracking_url' ) );
	}
	return false;
}

function chrono_get_shipment_datas( $order_id ) {
	$shipment_datas = get_post_meta( $order_id, '_shipment_datas', true );
	if ( is_array( $shipment_datas ) && isset( $shipment_datas[0] ) &&
		 ( array_key_exists( '_skybill_number', $shipment_datas[0] ) || array_key_exists( '_reservation_number', $shipment_datas[0] ) ) ) {
		return $shipment_datas;
	}

	return false;
}

function chrono_get_parcels_number( $order_id ) {
	return get_post_meta( $order_id, '_parcels_number', true ) ?: 1;
}

function chrono_is_shipping_methods_without_saturday( $shipping_method_id ) {
	$shippingMethodsNoSaturday = array(
		'chronorelaiseurope',
		'chronoexpress',
		'chronoclassic',
	);
	return in_array( $shipping_method_id, $shippingMethodsNoSaturday );
}

function chrono_get_parcels_dimensions( $order_id ) {
	return json_decode( get_post_meta( $order_id, '_parcels_dimensions', true ), true ) ?: array();
}

function chrono_notice( $message, $type = 'success', $modal = false, $args = array() ) {
	$class = 'notice notice-' . $type;

	/**
   * Define the array of defaults
   */
	$defaults = array(
		'width'  => 300,
		'height' => 500,
		'title'  => __( 'Information Chronopost' ),
	);

	/**
	 * Parse incoming $args into an array and merge it with $defaults
	 */
	$args = wp_parse_args( $args, $defaults );

	if ( ! $modal ) {
		return sprintf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	} else {
		$btnClose = '<button onclick="javascript:tb_remove()" class="button button-primary">' . __( 'I understand', 'chronopost' ) . '</button>';
		return sprintf( '<div class="%1$s" style="display: none"><div id="alertModal" data-title="' . esc_attr( $args['title'] ) . '" data-width="' . $args['width'] . '" data-height="' . $args['height'] . '"><p>%2$s</p><div style="text-align:center;">' . $btnClose . '</div></div></div>', esc_attr( $class ), esc_html( $message ) );
	}
}

function get_day_with_key( $key ) {
	$days = array(
		'sunday',
		'monday',
		'thuesday',
		'wednesday',
		'thursday',
		'friday',
		'saturday',
	);
	return array_key_exists( $key, $days ) ? $days[ $key ] : 'sunday';
}

function chrono_get_saturday_shipping_days() {
	$startday             = chrono_get_option( 'startday', 'saturday_slot', 4 );
	$endday               = chrono_get_option( 'endday', 'saturday_slot', 5 );
	$starttime            = chrono_get_option( 'starttime', 'saturday_slot', '15:00' );
	$endtime              = chrono_get_option( 'endtime', 'saturday_slot', '18:00' );
	$SaturdayShippingDays = array(
		'startday'  => get_day_with_key( $startday ),
		'endday'    => get_day_with_key( $endday ),
		'starttime' => $starttime . ':00',
		'endtime'   => $endtime . ':00',
	);
	return $SaturdayShippingDays;
}

function chrono_is_sending_day() {
	$satDays = chrono_get_saturday_shipping_days();

	$satDayStart  = date( 'N', strtotime( $satDays['startday'] ) );
	$satTimeStart = explode( ':', $satDays['starttime'] );

	$endDayStart  = date( 'N', strtotime( $satDays['endday'] ) );
	$endTimeStart = explode( ':', $satDays['endtime'] );

	$start = new DateTime( 'last sun' );
	// COMPAT < 5.36 : no chaining (returns null)
	$start->modify( '+' . $satDayStart . ' days' );
	$start->modify( '+' . $satTimeStart[0] . ' hours' );
	$start->modify( '+' . $satTimeStart[1] . ' minutes' );
	$end = new DateTime( 'last sun' );
	$end->modify( '+' . $endDayStart . ' days' );
	$end->modify( '+' . $endTimeStart[0] . ' hours' );
	$end->modify( '+' . $endTimeStart[1] . ' minutes' );

	if ( $end < $start ) {
		$end->modify( '+1 week' );
	}

	$end   = $end->getTimestamp();
	$start = $start->getTimestamp();

	$now = current_time( 'timestamp' );

	if ( $start <= $now && $now <= $end ) {
		return true;
	}
	return false;
}

function chrono_add_gmt_timestamp( $timestamp ) {
	//return $timestamp;
	// todo : verifier cette fonction
	return $timestamp - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
}

function chrono_get_post_datas( $str_post_datas = '' ) {
	$post_datas = array();
	foreach ( explode( '&', $str_post_datas ) as $chunk ) {
		$param = explode( '=', $chunk );
		if ( $param ) {
			if ( urldecode( $param[0] ) == 'chronopostprecise_creneaux_info' ) {
				$post_datas[ urldecode( $param[0] ) ] = json_decode( urldecode( $param[1] ) );
			} else {
				$post_datas[ urldecode( $param[0] ) ] = urldecode( $param[1] );
			}
		}
	}
	return $post_datas;
}

function chronopost_is_configured() {
	$contracts = chrono_get_all_contracts();

	// si il n'y a aucun contrat configuré, on affiche la notice
	if ( ! $contracts ) {
		return false;
	}
	$default_options = Chronopost_Admin_Display::get_default_values();

	foreach ( $contracts as $contract ) {
		// si l'un des contrats est un contrat avec une valeur par défaut, on laisse la notice
		if ( $contract['number'] == $default_options['contract'][1]['number'] ) {
			return false;
		}
	}

	// si les comptes sont ok, on valide la configuration
	return true;
}

function chronopost_methods_is_configured() {
	return is_array( get_option( 'chronopost_shipping_methods' ) );
}

function chrono_format_relay_address( $str ) {
	return ucwords( strtolower( $str ) );
}

/**
 * @param int $contract_number
 *
 * @return array
 */
function chrono_get_contract_infos( $contract_number ) {
	$infos = get_transient( 'contract_infos_' . $contract_number );
	if ( ! $infos ) {
		$accounts = chrono_get_option( 'accounts' );
		foreach ( $accounts as $account ) {
			if ( $account['number'] === $contract_number ) {
				$infos = $account;
				set_transient( 'contract_infos_' . $contract_number, $infos, 24 * 3600 );
			}
		}
	}
	return $infos;
}

/**
 * @param string $shipping_method_id
 *
 * @return bool|WC_Chronopost_Product
 */
function chrono_get_shipping_method_by_id( $shipping_method_id ) {
	$shipping_methods = WC()->shipping()->load_shipping_methods();

	if ( isset( $shipping_methods[ $shipping_method_id ] ) ) {
		return $shipping_methods[ $shipping_method_id ];
	}
	return false;
}

/**
 * @param int $order_id
 *
 * @return bool|WC_Chronopost_Product
 */
function chrono_get_shipping_method_by_order( $order_id ) {
	$_order                = new WC_Order( $order_id );
	$order_shipping_method = $_order->get_shipping_methods();
	$shipping_method       = reset( $order_shipping_method );
	$shipping_method_id    = $shipping_method->get_method_id();
	return chrono_get_shipping_method_by_id( $shipping_method_id );
}

function chrono_filter_by_value( $array, $index, $value ) {
	if ( is_array( $array ) && count( $array ) > 0 ) {
		foreach ( array_keys( $array ) as $key ) {
			$temp[ $key ] = $array[ $key ][ $index ];

			if ( $temp[ $key ] == $value ) {
				$newarray[ $key ] = $array[ $key ];
			}
		}
	}
	return $newarray;
}

/**
 * @return mixed
 */
function chrono_get_all_contracts() {
	$accounts = chrono_get_option( 'accounts' );

	if ( ! isset( $accounts[ key( $accounts ) ]['status'] ) ) {
		$accounts = chrono_get_option( 'accounts' );
	} else {
		$accounts = chrono_filter_by_value( chrono_get_option( 'accounts' ), 'status', 'success' );
	}

	return $accounts;
}

/**
 * Can we return the package ?
 * @param $country
 *
 * @return bool
 */
function chrono_can_return_package( $country ) {
	// Load whitelist
	$whitelistFile = fopen( plugin_dir_path( __FILE__ ) . '../csv/chronoretour.csv', 'r' );
	$whitelist     = fgetcsv( $whitelistFile );
	return in_array( $country, $whitelist );
}

/**
 * Vérifie les dimensions de plusieurs paquets (tableau)
 * @param array $dimensions
 *
 * @return bool|string
 */
function chrono_check_packages_dimensions( $shipping_method_id, $dimensions ) {
	foreach ( $dimensions as $parcel_dimension ) {
		if ( $shipping_method_id === 'chronorelais' || $shipping_method_id === 'chronorelaiseurope' || $shipping_method_id === 'chronorelaisdom' ) {
			$max_weight      = 20; // Kg
			$max_size        = 100; // cm
			$max_global_size = 250; //cm
		} else {
			$max_weight      = 30; // Kg
			$max_size        = 150; // cm
			$max_global_size = 300; // cm
		}
		if ( $parcel_dimension['weight'] > $max_weight ) {
			return sprintf( __( 'One or several packages are above the weight limit (%s kg)', 'chronopost' ), $max_weight );
		}
		if ( $parcel_dimension['width'] > $max_size || $parcel_dimension['height'] > $max_size || $parcel_dimension['length'] > $max_size ) {
			return sprintf( __( 'One or several packages are above the size limit (%s cm)', 'chronopost' ), $max_size );
		}
		if ( $parcel_dimension['width'] + ( 2 * $parcel_dimension['height'] ) + ( 2 * $parcel_dimension['length'] ) > $max_global_size ) {
			 return sprintf( __( 'One or several packages are above the total (L+2H+2l) size limit (%s cm)', 'chronopost' ), $max_global_size );
		}
	}
	return true;
}
