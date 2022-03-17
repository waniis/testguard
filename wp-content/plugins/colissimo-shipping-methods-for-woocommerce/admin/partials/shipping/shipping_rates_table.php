<?php
$shippingMethod  = $args['shippingMethod'];
$shippingClasses = $args['shippingClasses'];
$currentRates    = $shippingMethod->get_option('shipping_rates', []);
?>
<tr valign="top">
	<th scope="row" class="titledesc"><?php esc_html_e(__('Shipping rates', 'wc_colissimo')); ?></th>
	<td class="forminp" id="<?php echo $shippingMethod->id; ?>_shipping_rates">
		<table class="shippingrows widefat" cellspacing="0">
			<thead>
				<tr>
					<td class="check-column"><input type="checkbox"></td>
                    <?php
                    $currency    = get_woocommerce_currency();
                    $currencyTxt = ' (' . $currency . ' ' . get_woocommerce_currency_symbol($currency) . ')';
                    $weightUnit  = ' (' . LpcHelper::get_option('woocommerce_weight_unit', '') . ')';
                    ?>
					<th>
                        <?php esc_html_e(__('From weight', 'wc_colissimo') . $weightUnit); ?>
						<span class="woocommerce-help-tip" data-tip="<?php esc_html_e(__('Included', 'wc_colissimo')); ?>"
							  title="<?php esc_html_e(__('Included', 'wc_colissimo')); ?>"></span>
					</th>
					<th>
                        <?php esc_html_e(__('To weight', 'wc_colissimo') . $weightUnit); ?>
						<span class="woocommerce-help-tip" data-tip="<?php esc_html_e(__('Excluded', 'wc_colissimo')); ?>"
							  title="<?php esc_html_e(__('Excluded', 'wc_colissimo')); ?>"></span>
					</th>
					<th>
                        <?php esc_html_e(__('From cart price', 'wc_colissimo') . $currencyTxt); ?>
						<span class="woocommerce-help-tip" data-tip="<?php esc_html_e(__('Included', 'wc_colissimo')); ?>"
							  title="<?php esc_html_e(__('Included', 'wc_colissimo')); ?>"></span>
					</th>
					<th>
                        <?php esc_html_e(__('To cart price', 'wc_colissimo') . $currencyTxt); ?>
						<span class="woocommerce-help-tip" data-tip="<?php esc_html_e(__('Excluded', 'wc_colissimo')); ?>"
							  title="<?php esc_html_e(__('Exclude', 'wc_colissimo')); ?>"></span>
					</th>
					<th>
                        <?php esc_html_e(__('Shipping class', 'wc_colissimo')); ?>
					</th>
					<th>
                        <?php esc_html_e(__('Price', 'wc_colissimo')); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th colspan="7">
						<a href="#" class="add button" id="lpc_shipping_rates_add"
						   style="margin-left: 24px"><?php esc_html_e(__('Add rate', 'wc_colissimo')); ?></a>
						<a href="#" class="remove button"
						   id="lpc_shipping_rates_remove"><?php esc_html_e(__('Delete selected', 'wc_colissimo')); ?></a>
					</th>
				</tr>
			</tfoot>
			<tbody class="table_rates">
                <?php


                // From version 1.4, every shipping rates can have multiple shipping classes
                $isFromPre14Configuration = false;
                array_walk(
                    $currentRates,
                    function (&$rate) use (&$isFromPre14Configuration) {
                        if (isset($rate['shipping_class']) && !is_array($rate['shipping_class'])) {
                            $isFromPre14Configuration = true;
                            $rate['shipping_class']   = [$rate['shipping_class']];
                        }
                    }
                );

                // Migration process from version 1.2 and 1.3
                if ($isFromPre14Configuration) {
                    $result             = [];
                    $alreadyProcessedId = [];

                    foreach ($currentRates as $i => $rate) {
                        if (isset($rate['shipping_class'])) {
                            if (in_array($i, $alreadyProcessedId)) {
                                continue;
                            }

                            $alreadyProcessedId[] = $i;
                            $tmpRate              = $rate;

                            foreach ($currentRates as $testKey => $testRate) {
                                if (
                                    $testRate['min_price'] === $rate['min_price']
                                    && $testRate['max_price'] === $rate['max_price']
                                    && $testRate['min_weight'] === $rate['min_weight']
                                    && $testRate['max_weight'] === $rate['max_weight']
                                    && $testRate['price'] === $rate['price']
                                    && !in_array(
                                        LpcAbstractShipping::LPC_ALL_SHIPPING_CLASS_CODE,
                                        $testRate['shipping_class']
                                    )
                                    && !in_array(
                                        LpcAbstractShipping::LPC_ALL_SHIPPING_CLASS_CODE,
                                        $rate['shipping_class']
                                    )
                                    && !in_array($testKey, $alreadyProcessedId)
                                ) {
                                    $tmpRate['shipping_class'] = array_merge(
                                        $tmpRate['shipping_class'],
                                        $testRate['shipping_class']
                                    );

                                    $alreadyProcessedId[] = $testKey;
                                }
                            }

                            $result[] = $tmpRate;
                        }
                    }

                    if (!empty($result)) {
                        $currentRates = $result;
                    }
                }

                $counter = 0;
                $len     = count($currentRates);

                foreach ($currentRates as $i => $rate) {
                    // Migration process from version 1.1 or lower
                    if (isset($rate['weight'])) {
                        if ('yes' === $shippingMethod->get_instance_option('use_cart_price', 'no')) {
                            $rate['min_price'] = $rate['weight'];

                            $rate['max_price'] = $i === $len - 1
                                ? $shippingMethod->get_instance_option('max_weight', 99999)
                                : $currentRates[$counter + 1]['weight'];

                            $rate['min_weight'] = 0;
                            $rate['max_weight'] = 99999;
                        } else {
                            $rate['min_weight'] = $rate['weight'];
                            $rate['max_weight'] = $i === $len - 1
                                ? $shippingMethod->get_instance_option('max_weight', 99999)
                                : $currentRates[$counter + 1]['weight'];

                            $rate['min_price'] = 0;
                            $rate['max_price'] = 99999;
                        }

                        $counter ++;
                    }
                    ?>
					<tr>
						<td class="check-column"><input type="checkbox" /></td>
						<td style="text-align: center">
							<input type="number"
								   class="input-number regular-input"
								   step="any"
								   min="0"
								   required
								   value="<?php echo isset($rate['min_weight']) ? esc_attr($rate['min_weight']) : ''; ?>"
								   name="shipping_rates[<?php echo $i; ?>][min_weight]" />
						</td>
						<td style="text-align: center">
							<input type="number"
								   class="input-number regular-input"
								   step="any"
								   min="0"
								   required
								   value="<?php echo isset($rate['max_weight']) ? esc_attr($rate['max_weight']) : ''; ?>"
								   name="shipping_rates[<?php echo $i; ?>][max_weight]" />
						</td>
						<td style="text-align: center">
							<input type="number"
								   class="input-number regular-input"
								   step="any"
								   min="0"
								   required
								   value="<?php echo isset($rate['min_price']) ? esc_attr($rate['min_price']) : ''; ?>"
								   name="shipping_rates[<?php echo $i; ?>][min_price]" />
						</td>
						<td style="text-align: center">
							<input type="number"
								   class="input-number regular-input"
								   step="any"
								   min="0"
								   required
								   value="<?php echo isset($rate['max_price']) ? esc_attr($rate['max_price']) : ''; ?>"
								   name="shipping_rates[<?php echo $i; ?>][max_price]" />
						</td>
						<td style="text-align: center">
							<select style="width: auto; max-width: 10rem"
									name="shipping_rates[<?php echo $i; ?>][shipping_class][]"
									multiple="multiple"
									class="lpc__shipping_rates__shipping_class__select">
								<option value="<?php echo LpcAbstractShipping::LPC_ALL_SHIPPING_CLASS_CODE; ?>"
                                    <?php echo empty($rate['shipping_class']) || in_array(
                                        'all',
                                        $rate['shipping_class']
                                    ) ? 'selected="selected"' : ''; ?>>
                                    <?php
                                    esc_html_e(__('All products', 'wc_colissimo'));
                                    ?>
								</option>
                                <?php
                                foreach ($shippingClasses as $oneClass) {
                                    echo '<option value="' . $oneClass->term_id . '" ' . (
                                        isset($rate['shipping_class']) && in_array(
                                            $oneClass->term_id,
                                            $rate['shipping_class']
                                        ) ? 'selected="selected"' : ''
                                        )
                                         . '>' . $oneClass->name . '</option>';
                                }
                                ?>
							</select>
						</td>
						<td style="text-align: center">
							<input type="number"
								   class="input-number regular-input"
								   step="any"
								   min="0"
								   required
								   value="<?php echo esc_attr($rate['price']); ?>"
								   name="shipping_rates[<?php echo $i; ?>][price]" />
						</td>
					</tr>
                    <?php $counter ++;
                } ?>
			</tbody>
		</table>
	</td>
</tr>
<div id="lpc_shipping_classes_example" style="display: none">
	<option selected="selected" value="<?php echo LpcAbstractShipping::LPC_ALL_SHIPPING_CLASS_CODE; ?>">
        <?php esc_html_e(__('All products', 'wc_colissimo')); ?>
	</option>
    <?php
    foreach ($shippingClasses as $oneClass) {
        echo '<option value="' . $oneClass->term_id . '">' . $oneClass->name . '</option>';
    }
    ?>
</div>
<script type="text/javascript">
    window.lpc_i18n_delete_selected_rate = "<?php echo esc_attr('Delete the selected rates?'); ?>";
</script>
