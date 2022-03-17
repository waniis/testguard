<?php
$trackingNumbers = isset($args['lpc_tracking_numbers']) ? $args['lpc_tracking_numbers'] : [];
$labelFormat     = isset($args['lpc_label_formats']) ? $args['lpc_label_formats'] : [];
$orderItems      = isset($args['lpc_order_items']) && is_array($args['lpc_order_items']) ? $args['lpc_order_items'] : [];
$weightUnity     = LpcHelper::get_option('woocommerce_weight_unit', '');
$currency        = get_woocommerce_currency_symbol(get_woocommerce_currency());
$shippingCosts   = isset($args['lpc_shipping_costs']) ? $args['lpc_shipping_costs'] : 0;
?>

<div class="lpc__admin__order_banner">
	<div class="lpc__admin__order_banner__header">
		<div class="lpc__admin__order_banner__header__listing nav-tab nav-tab-active"><?php echo __('Labels listing', 'wc_colissimo'); ?></div>
		<div class="lpc__admin__order_banner__header__generation nav-tab"><?php echo __('Labels generation', 'wc_colissimo'); ?></div>
	</div>
	<div class="lpc__admin__order_banner__generate_label">
		<div class="lpc__admin__order_banner__generate_label__div" style="display: none">
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th class="check-column"><input type="checkbox" class="lpc__admin__order_banner__generate_label__item__check_all" checked="checked"></th>
						<th><?php echo __('Item', 'woocommerce'); ?></th>
						<th><?php echo sprintf(__('Unit price (%s)', 'wc_colissimo'), $currency); ?></th>
						<th><?php echo __('Quantity', 'wc_colissimo'); ?></th>
						<th><?php echo sprintf(__('Unit weight (%s)', 'wc_colissimo'), $weightUnity); ?></th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $allItemsId = [];
                    foreach ($orderItems as $oneItem) {
                        $allItemsId[] = $oneItem['id'];
                        ?>
						<tr>
							<td class="lpc__admin__order_banner__generate_label__item__td__checkbox check-column">
								<input type="checkbox"
									   data-item-id="<?php echo $oneItem['id']; ?>"
									   class="lpc__admin__order_banner__generate_label__item__checkbox"
									   checked
									   name="<?php echo $oneItem['id'] . '-checkbox'; ?>"
									   id="<?php echo $oneItem['id'] . '-checkbox'; ?>"
								></td>
							<td><?php echo $oneItem['name']; ?></td>
							<td><input type="number"
									   class="lpc__admin__order_banner__generate_label__item__price"
									   data-item-id="<?php echo $oneItem['id']; ?>"
									   value="<?php echo $oneItem['price']; ?>"
									   name="<?php echo $oneItem['id'] . '-price'; ?>"
									   min="0"
									   step="any"
									   readonly="readonly"
								></td>
							<td><input type="number"
									   class="lpc__admin__order_banner__generate_label__item__qty"
									   data-item-id="<?php echo $oneItem['id']; ?>"
									   value="<?php echo $oneItem['qty']; ?>"
									   step="1"
									   min="0"
									   name="<?php echo $oneItem['id'] . '-qty'; ?>"
									   id="<?php echo $oneItem['id'] . '-qty'; ?>"
								></td>
							<td><input type="number"
									   class="lpc__admin__order_banner__generate_label__item__weight"
									   data-item-id="<?php echo $oneItem['id']; ?>"
									   value="<?php echo $oneItem['weight']; ?>"
									   min="0"
									   step="any"
									   readonly="readonly"
									   name="<?php echo $oneItem['id'] . '-weight'; ?>"
								></td>
						</tr>
                    <?php } ?>
				</tbody>
			</table>
			<div class="lpc__admin__order_banner__generate_label__edit_value__container">
				<span class="woocommerce-help-tip" data-tip="
				<?php
                echo __('Editing prices and weights may create inconsistency between CN23 or labels and invoice. Edit these values only if you really need it.',
                        'wc_colissimo');
                ?>
				">
				</span>
                <?php echo __('Edit prices and weights', 'wc_colissimo'); ?>
				<span class="lpc__admin__order_banner__generate_label__edit_value woocommerce-input-toggle woocommerce-input-toggle--disabled"></span>
			</div>
			<div class="lpc__admin__order_banner__generate_label__shipping_costs__container">
				<label for="lpc__admin__order_banner__generate_label__shipping_costs">
                    <?php echo sprintf(__('Shipping costs (%s)', 'wc_colissimo'), $currency); ?>
				</label>
				<input type="number"
					   min="0"
					   step="any"
					   class="lpc__admin__order_banner__generate_label__shipping_costs"
					   id="lpc__admin__order_banner__generate_label__shipping_costs"
					   name="lpc__admin__order_banner__generate_label__shipping_costs"
					   value="<?php echo $shippingCosts; ?>"
					   readonly="readonly"
				>
			</div>
			<div class="lpc__admin__order_banner__generate_label__package_weight__container">
				<label for="lpc__admin__order_banner__generate_label__package_weight">
                    <?php echo sprintf(__('Packaging weight (%s)', 'wc_colissimo'), $weightUnity); ?>
				</label>
				<input type="number"
					   min="0"
					   step="any"
					   class="lpc__admin__order_banner__generate_label__package_weight"
					   name="lpc__admin__order_banner__generate_label__package_weight"
					   id="lpc__admin__order_banner__generate_label__package_weight"
					   value="<?php echo $args['lpc_packaging_weight']; ?>"
					   readonly="readonly"
				>
			</div>
			<div class="lpc__admin__order_banner__generate_label__total_weight__container">
                <?php echo __('Total weight (items + packaging)', 'wc_colissimo'); ?> :
				<span class="lpc__admin__order_banner__generate_label__total_weight"></span><?php echo ' ' . $weightUnity; ?>
				<input type="hidden" name="lpc__admin__order_banner__generate_label__total_weight__input">
			</div>
			<div class="lpc__admin__order_banner__generate_label__generate-label-button__container">
				<select name="lpc__admin__order_banner__generate_label__outward_or_inward">
					<option value="outward"><?php echo __('Outward label', 'wc_colissimo'); ?></option>
					<option value="inward"><?php echo __('Inward label', 'wc_colissimo'); ?></option>
					<option value="both"><?php echo __('Outward and inward labels', 'wc_colissimo'); ?></option>
				</select>
				<button type="button" class="button button-primary lpc__admin__order_banner__generate_label__generate-label-button"><?php echo __('Generate',
                                                                                                                                                  'wc_colissimo'); ?></button>
			</div>
		</div>
	</div>
	<div class="lpc__admin__order_banner__label_listing">
        <?php if (empty($trackingNumbers)) {
            $message = __('You don\'t have any label for this order. To generate one, please check the "Labels generation" tab',
                          'wc_colissimo');

            echo '<br><div class="lpc__admin__order_banner__warning"><span>' . $message . '</span></div>';
        } else { ?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th><?php echo __('Outward labels', 'wc_colissimo'); ?></th>
						<th><?php echo __('Inward labels', 'wc_colissimo'); ?></th>
					</tr>
				</thead>
				<tbody class="lpc__admin__order_banner__label_listing__body">
                    <?php
                    foreach ($trackingNumbers as $outwardTrackingNumber => $inwardTrackingNumbers) {
                        ?>
						<tr>
							<td>
                                <?php
                                if ('no_outward' !== $outwardTrackingNumber) {
                                    echo $outwardTrackingNumber; ?>
									<br>
                                    <?php echo $args['lpc_label_queries']->getOutwardLabelsActionsIcons(
                                        $outwardTrackingNumber,
                                        $labelFormat[$outwardTrackingNumber],
                                        $args['lpc_redirection']
                                    );
                                } ?>
							</td>
							<td>
                                <?php foreach ($inwardTrackingNumbers as $inwardTrackingNumber) { ?>
                                    <?php echo $inwardTrackingNumber; ?>
									<br>
                                    <?php echo $args['lpc_label_queries']->getInwardLabelsActionsIcons(
                                        $inwardTrackingNumber,
                                        $labelFormat[$inwardTrackingNumber],
                                        $args['lpc_redirection']
                                    ); ?>
									<br>
                                <?php } ?>
							</td>
						</tr>
                    <?php } ?>
				</tbody>
			</table>
        <?php } ?>
	</div>
	<input type="hidden" name="lpc__admin__order_banner__generate_label__action" value="0">
	<input type="hidden" name="lpc__admin__order_banner__generate_label__items-id" value="<?php echo serialize($allItemsId); ?>">
</div>
