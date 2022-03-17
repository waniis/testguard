<?php
do_action('woocommerce_email_header', $email_heading, $email); ?>
	<p><?php printf(__('Hi %s,', 'wc_colissimo'), $order->get_billing_first_name()); ?></p>
	<p><?php printf(__('The inward label for order #%s has been generated.', 'wc_colissimo'), $order->get_order_number()); ?></p>

<?php
do_action('woocommerce_email_footer', $email);
