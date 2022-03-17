<?php
/**
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! $notices ) {
	return;
}
?>

<div class="udy-wc-notices-wrapper <?php echo is_ajax() ? "is-ajax" : ""; ?> notices---copy-this">
<?php foreach ( $notices as $notice )  : ?>
	<div item="notice-error" class="notice-error">
        <div item="message" class="notice-error-msg"><?php echo wc_kses_notice( $notice['notice'] ); ?></div>
      </div>
<?php endforeach; ?>
</div>