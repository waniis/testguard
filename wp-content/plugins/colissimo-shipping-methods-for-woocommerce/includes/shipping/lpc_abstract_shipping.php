<?php

require_once LPC_INCLUDES . 'shipping' . DS . 'lpc_capabilities_per_country.php';

abstract class LpcAbstractShipping extends WC_Shipping_Method {
    const LPC_ALL_SHIPPING_CLASS_CODE = 'all';
    const LPC_LAPOSTE_TRACKING_LINK = 'https://www.laposte.fr/outils/suivre-vos-envois?code={lpc_tracking_number}';

    protected $lpcCapabilitiesPerCountry;

    /**
     * LpcAbstractShipping constructor.
     *
     * @param int $instance_id
     */
    public function __construct($instance_id = 0) {
        $this->instance_id = absint($instance_id);
        $this->supports    = [
            'shipping-zones',
            'instance-settings',
        ];

        $this->lpcCapabilitiesPerCountry = new LpcCapabilitiesPerCountry();
        $this->init();
    }

    /**
     * This method is used to initialize the configuration fields' values
     */
    public function init() {
        // Load the settings
        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
    }

    /**
     * This method allows you to define configuration fields shown in the shipping methdod's configuration page
     */
    public function init_form_fields() {
        $this->instance_form_fields = [
            'title'          => [
                'title'       => __('Title', 'wc_colissimo'),
                'type'        => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'wc_colissimo'),
                'default'     => $this->method_title,
                'desc_tip'    => true,
            ],
            'title_free'     => [
                'title'       => __('Title if free', 'wc_colissimo'),
                'type'        => 'text',
                'description' => __(
                    'This controls the title which the user sees during checkout if the shipping methods is free. Leave empty to always use standard title.',
                    'wc_colissimo'
                ),
                'default'     => $this->get_option('title_free', ''),
                'desc_tip'    => true,
            ],
            'shipping_rates' => [
                'title'       => __('Rates', 'wc_colissimo'),
                'type'        => 'shipping_rates',
                'description' => __('Rates by weight', 'wc_colissimo'),
                'default'     => '',
                'desc_tip'    => true,
            ],
        ];
    }

    public function generate_shipping_rates_html() {
        $shipping        = new \WC_Shipping();
        $shippingClasses = $shipping->get_shipping_classes();

        return LpcHelper::renderPartial(
            'shipping' . DS . 'shipping_rates_table.php',
            [
                'shippingMethod'  => $this,
                'shippingClasses' => $shippingClasses,
            ]
        );
    }

    public function validate_shipping_rates_field($key) {
        $result = [];
        foreach ($this->get_post_data()[$key] as $rate) {
            $minWeight = (float) str_replace(',', '.', $rate['min_weight']);
            $maxWeight = (float) str_replace(',', '.', $rate['max_weight']);
            $minPrice  = (float) str_replace(',', '.', $rate['min_price']);
            $maxPrice  = (float) str_replace(',', '.', $rate['max_price']);

            $minWeight = max($minWeight, 0);
            $maxWeight = max($minWeight, $maxWeight, 0);
            $minPrice  = max($minPrice, 0);
            $maxPrice  = max($maxPrice, $minPrice, 0);

            $item = [
                'min_weight'     => $minWeight,
                'max_weight'     => $maxWeight,
                'min_price'      => $minPrice,
                'max_price'      => $maxPrice,
                'shipping_class' => $rate['shipping_class'],
                'price'          => (float) str_replace(',', '.', $rate['price']),
            ];

            $result[] = $item;
        }

        usort(
            $result,
            function ($a, $b) {
                $result = 0;

                if ($a['price'] > $b['price']) {
                    $result = 1;
                } else {
                    if ($a['price'] < $b['price']) {
                        $result = - 1;
                    }
                }

                return $result;
            }
        );

        return $result;
    }

    public function getRates() {
        return $this->get_option('shipping_rates', []);
    }

    public function getMaximumWeight() {
        return $this->get_option('max_weight', null);
    }

    public function getUseCartPrice() {
        return $this->get_option('use_cart_price', 'no');
    }

    abstract public function isAlwaysFree();

    abstract public function freeFromOrderValue();

    public function calculate_shipping($package = []) {
        $cost = null;

        if ($this->lpcCapabilitiesPerCountry->getInfoForDestination($package['destination']['country'], $this->id)) {
            $totalWeight         = 0;
            $totalPrice          = 0;
            $cartShippingClasses = [];
            $rates               = $this->getRates();

            array_walk(
                $rates,
                function (&$rate) {
                    if (isset($rate['shipping_class']) && !is_array($rate['shipping_class'])) {
                        $rate['shipping_class'] = [$rate['shipping_class']];
                    }
                }
            );

            $lineTotal = 0;
            $lineTax   = 0;

            foreach ($package['contents'] as $item) {
                $product               = $item['data'];
                $totalWeight           += (float) $product->get_weight() * $item['quantity'];
                $cartShippingClasses[] = $product->get_shipping_class_id();

                $lineTotal = $lineTotal + $item['line_total'];
                $lineTax   = $lineTax + $item['line_tax'];
            }

            // For the future, if we want to calculate price on HorsTaxes checkout, we only need to calculate on $lineTotal
            $totalPrice = round($lineTax + $lineTotal, 2);

            // Remove duplicate shipping classes
            $cartShippingClasses = array_unique($cartShippingClasses);

            // For configuration of version 1.1 or lower
            if (isset($rates[0]['weight'])) {
                // Should we compare to cart weight or cart price
                if ('yes' === $this->getUseCartPrice()) {
                    $totalValue = $totalPrice;
                } else {
                    $totalValue = $totalWeight;
                }

                // Maximum weight or price depending on option value
                $maximumWeight = $this->getMaximumWeight();
                if ($maximumWeight && $totalValue > $maximumWeight) {
                    return; // no rates
                }
            }

            $coupons              = $package['applied_coupons'];
            $isCouponFreeShipping = false;

            foreach ($coupons as $oneCouponCode) {
                $coupon = new WC_Coupon($oneCouponCode);
                if ($coupon->get_free_shipping()) {
                    $isCouponFreeShipping = true;
                    break;
                }
            }

            if (
                'yes' === $this->isAlwaysFree()
                || ($this->freeFromOrderValue() > 0 && $totalPrice >= $this->freeFromOrderValue())
                || $isCouponFreeShipping
            ) {
                $cost = 0.0;
            } else {
                // For configuration of version 1.1 or lower
                if (isset($rates[0]['weight'])) {
                    usort(
                        $rates,
                        function ($a, $b) {
                            if ($a['weight'] == $b['weight']) {
                                return 0;
                            }

                            return ($a['weight'] < $b['weight']) ? - 1 : 1;
                        }
                    );

                    foreach ($rates as $rate) {
                        if ($rate['weight'] <= $totalValue) {
                            $cost = $rate['price'];
                        }
                    }
                } else {
                    $matchingRates = [];

                    // Step 1 : retrieve all matching line rate with price, weight and shipping classes
                    foreach ($rates as $oneRate) {
                        if (
                            $totalWeight >= $oneRate['min_weight']
                            && $totalWeight < $oneRate['max_weight']
                            && $totalPrice >= $oneRate['min_price']
                            && $totalPrice < $oneRate['max_price']
                            && (
                                !empty(array_intersect($oneRate['shipping_class'], $cartShippingClasses))
                                || in_array(self::LPC_ALL_SHIPPING_CLASS_CODE, $oneRate['shipping_class'])
                            )
                        ) {
                            $matchingRates[] = $oneRate;
                        }
                    }

                    $matchingShippingClassesRates = [];

                    // Step 2 : Match each shipping classes with corresponding line rates
                    foreach ($cartShippingClasses as $oneCartShippingClassId) {

                        // Step 2.1 : First check if a line rates is corresponding with a shipping class defined
                        if (!empty($oneCartShippingClassId)) {
                            $matchingShippingClassesRates[$oneCartShippingClassId] = array_filter(
                                $matchingRates,
                                function ($rate) use ($oneCartShippingClassId) {
                                    return in_array($oneCartShippingClassId, $rate['shipping_class']);
                                }
                            );
                        }

                        // Step 2.2 : If no line rates corresponding with shipping rates or if no shipping class is set, check the line rates for all shipping classes
                        if (empty($matchingShippingClassesRates[$oneCartShippingClassId]) || '0' == $oneCartShippingClassId) {
                            $matchingShippingClassesRates[$oneCartShippingClassId] = array_filter(
                                $matchingRates,
                                function ($rate) use ($oneCartShippingClassId) {
                                    return in_array(self::LPC_ALL_SHIPPING_CLASS_CODE, $rate['shipping_class']);
                                }
                            );
                        }
                    }

                    $shippingClassPrices = [];

                    // Step 3 : For each shipping class of the cart, take the cheapest line rate
                    foreach ($matchingShippingClassesRates as $shippingClassId => $oneShippingMethodRate) {
                        foreach ($oneShippingMethodRate as $oneRate) {
                            if (!isset($shippingClassPrices[$shippingClassId])) {
                                $shippingClassPrices[$shippingClassId] = $oneRate['price'];
                            } elseif ($shippingClassPrices[$shippingClassId] > $oneRate['price']) {
                                $shippingClassPrices[$shippingClassId] = $oneRate['price'];
                            }
                        }
                    }

                    // Step 4 : Take the more expensive shipping class
                    foreach ($shippingClassPrices as $onePrice) {
                        if (null === $cost || $onePrice > $cost) {
                            $cost = $onePrice;
                        }
                    }
                }
            }

            if (null !== $cost) {
                $titleFree = $this->get_option('title_free', '');
                $label     = 0 == $cost && !empty($titleFree) ? $titleFree : $this->title;

                $translatedLabel = __($label, 'wc_colissimo');

                $rate = [
                    'id'    => $this->id,
                    'label' => $translatedLabel,
                    'cost'  => $cost,
                ];

                $this->add_rate($rate);
            }
        }
    }
}
