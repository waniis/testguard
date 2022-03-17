<div class="lpc_tracking">
	<div class="lpc_tracking_logo">
		<img src="<?php echo esc_html($args['logoUrl']); ?>" alt="Logo colissimo" style="margin: auto;" />
	</div>

	<h2 class="lpc_tracking_title">
        <?php echo esc_html__('Tracking information for order', 'wc_colissimo'); ?>
		<b>#<?php echo esc_html($args['order']->get_order_number()); ?></b>
	</h2>
	<p class="lpc_tracking_method">
        <?php echo esc_html__('Shipping method', 'wc_colissimo'); ?> :
		<b><?php echo esc_html($args['order']->get_shipping_method()); ?></b>
	</p>

    <?php
    $trackingNumber = $args['trackingInfo']->parcel->parcelNumber;
    ?>

	<hr class="lpc_tracking_separator" />

	<div class="lpc_tracking_summary">
		<table>
			<thead>
				<tr>
					<th>
                        <?php echo esc_html__('Tracking number', 'wc_colissimo'); ?>
					</th>
					<th>
                        <?php echo esc_html__('Status', 'wc_colissimo'); ?>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="lpc_tracking_tracknumber">
                        <?php echo esc_html($trackingNumber); ?>
					</td>
					<td>
                        <?php echo esc_html($args['trackingInfo']->mainStatus); ?>
					</td>
					<td>
						<a target="_blank"
						   href="https://www.laposte.fr/particulier/modification-livraison?code=<?php echo esc_attr($trackingNumber); ?>">
                            <?php echo esc_html__('Change your shipping information and options', 'wc_colissimo'); ?>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="lpc_tracking_message">
        <?php echo @$args['trackingInfo']->message->message; ?>
	</div>

	<h3>
        <?php echo esc_html__('Status history', 'wc_colissimo'); ?>
	</h3>
	<div class="lpc_tracking_events">
		<table>
			<thead>
				<tr>
					<th>
                        <?php echo esc_html__('Status Date', 'wc_colissimo'); ?>
					</th>
					<th>
                        <?php echo esc_html__('Status', 'wc_colissimo'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
                <?php
                foreach ($args['trackingInfo']->parcel->event as $event) {
                    ?>
					<tr>
						<td>
                            <?php
                            $date = new DateTime($event->date);
                            $date = $date->format('d/m/Y');
                            echo esc_html($date);
                            ?>
						</td>
						<td>
                            <?php echo esc_html($event->label); ?>
						</td>
					</tr>
                <?php } ?>
			</tbody>
		</table>
	</div>
</div>
