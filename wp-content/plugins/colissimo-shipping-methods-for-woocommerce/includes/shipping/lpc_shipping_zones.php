<?php

class LpcShippingZones extends LpcComponent {
    const UNKNOWN_WC_COUNTRIES = ['AN', 'IC'];

    private $addCustomZonesDone = false;
    protected $lpcCapabilitiesPerCountry;

    public function __construct(LpcCapabilitiesPerCountry $lpcCapabilitiesPerCountry = null) {
        $this->lpcCapabilitiesPerCountry = LpcRegister::get('capabilitiesPerCountry', $lpcCapabilitiesPerCountry);
    }

    public function getDependencies() {
        return ['capabilitiesPerCountry'];
    }

    public function init() {
        // only at plugin installation
        register_activation_hook(
            LPC_FOLDER . 'index.php',
            function () {
                $this->addCustomZonesOrUpdateOne();
            }
        );
    }

    public function addCustomZonesOrUpdateOne($zoneName = '') {
        if ($this->addCustomZonesDone) {
            return;
        }

        $currentZones = [];
        foreach (WC_Shipping_Zones::get_zones() as $zone) {
            $currentZones[$zone['zone_name']] = $zone;
        }

        foreach ($this->lpcCapabilitiesPerCountry->getCapabilitiesPerCountry() as $zoneDefinition) {
            if (!empty($zoneName) && $zoneDefinition['name'] !== $zoneName) {
                continue;
            }

            $countries       = [];
            $shippingMethods = [];
            foreach ($zoneDefinition['countries'] as $countryCode => $countryDefinition) {
                $countries[] = $countryCode;

                if (@$countryDefinition['lpc_nosign']) {
                    $shippingMethods['lpc_nosign'] = true;
                }
                if (@$countryDefinition['lpc_sign']) {
                    $shippingMethods['lpc_sign'] = true;
                }
                if (@$countryDefinition['lpc_relay']) {
                    $shippingMethods['lpc_relay'] = true;
                }
                if (@$countryDefinition['lpc_expert']) {
                    $shippingMethods['lpc_expert'] = true;
                }
            }

            $this->addCustomZone(
                $zoneDefinition['name'],
                $countries,
                array_keys($shippingMethods),
                $currentZones
            );
        }

        $this->addCustomZonesDone = true;
    }

    protected function addCustomZone($zoneName, array $countries, array $shippingMethods, array $currentZones) {
        global $wpdb;

        $newZone = null;
        if (!empty($currentZones[$zoneName])) {
            $newZone = $currentZones[$zoneName];
        }
        if (empty($newZone['id'])) {
            $newZone = new WC_Shipping_Zone();
        } else {
            $newZone = WC_Shipping_Zones::get_zone($newZone['id']);
        }

        $newZone->set_zone_name($zoneName);

        $existingZoneLocations = array_map(
            function ($v) {
                return $v->code;
            },
            array_filter(
                $newZone->get_zone_locations(),
                function ($v) {
                    return 'country' === $v->type;
                }
            )
        );
        foreach ($countries as $country) {
            if (!in_array($country, self::UNKNOWN_WC_COUNTRIES)) {
                if (!in_array($country, $existingZoneLocations)) {
                    $newZone->add_location($country, 'country');
                }
            }
        }

        $existingShippingMethods = array_map(
            function ($v) {
                return $v->id;
            },
            $newZone->get_shipping_methods()
        );
        foreach ($shippingMethods as $shippingMethod) {
            if (!in_array($shippingMethod, $existingShippingMethods)) {
                $shippingMethodInstanceId = $newZone->add_shipping_method($shippingMethod);

                $wpdb->update(
                    "{$wpdb->prefix}woocommerce_shipping_zone_methods",
                    [
                        'is_enabled' => false,
                    ],
                    [
                        'instance_id' => $shippingMethodInstanceId,
                    ]
                );
            }
        }

        $newZone->save();
    }

}
