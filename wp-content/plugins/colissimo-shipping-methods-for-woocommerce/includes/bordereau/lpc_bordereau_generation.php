<?php

class LpcBordereauGeneration extends LpcComponent {
    const MAX_LABEL_PER_BORDEREAU = 50;
    const BORDEREAU_ID_META_KEY = 'lpc_bordereau_id';

    /** @var LpcBordereauGenerationApi */
    protected $bordereauGenerationApi;
    /** @var LpcOutwardLabelDb */
    protected $outwardLabelDb;

    public function __construct(
        LpcBordereauGenerationApi $bordereauGenerationApi = null,
        LpcOutwardLabelDb $outwardLabelDb = null
    ) {
        $this->bordereauGenerationApi = LpcRegister::get('bordereauGenerationApi', $bordereauGenerationApi);
        $this->outwardLabelDb         = LpcRegister::get('outwardLabelDb', $outwardLabelDb);
    }

    public function getDependencies() {
        return ['bordereauGenerationApi', 'outwardLabelDb'];
    }

    /**
     * @param WC_Order[] $orders
     *
     * @return string|null Return the bodereau if only one bodereau was generated, else null.
     */
    public function generate(array $orders) {
        $ordersId = array_map(
            function (WC_Order $order) {
                return $order->get_id();
            },
            $orders
        );

        $ordersLabelsInformation = $this->outwardLabelDb->getLabelsInfosForOrdersId($ordersId);

        $orderIdByOutwardsTrackingNumbers = [];

        foreach ($ordersLabelsInformation as $oneOrdersLabelsInformation) {
            if (!empty($oneOrdersLabelsInformation->tracking_number) && !empty($oneOrdersLabelsInformation->order_id)) {
                $orderIdByOutwardsTrackingNumbers[$oneOrdersLabelsInformation->tracking_number] = $oneOrdersLabelsInformation->order_id;
            }
        }

        $trackingNumbersPerBatch = $this->prepareBatch($orderIdByOutwardsTrackingNumbers);

        foreach ($trackingNumbersPerBatch as $batchOfTrackingNumbers) {
            $retrievedBordereau = $this->bordereauGenerationApi->generateBordereau(array_keys($batchOfTrackingNumbers));

            $bordereau   = $retrievedBordereau->bordereau;
            $bordereauId = $bordereau->bordereauHeader->bordereauNumber;

            $newStatus = LpcHelper::get_option('lpc_order_status_on_bordereau_generated');

            $ordersIdForBatch = array_unique($batchOfTrackingNumbers);

            foreach ($ordersIdForBatch as $orderId) {
                $order = wc_get_order($orderId);

                update_post_meta($orderId, self::BORDEREAU_ID_META_KEY, $bordereauId);
                if (!empty($newStatus) && 'unchanged_order_status' !== $newStatus) {
                    $order->update_status($newStatus);
                }

                $email_outward_label = LpcHelper::get_option(LpcOutwardLabelEmailManager::EMAIL_OUTWARD_TRACKING_OPTION, 'no');
                if (LpcOutwardLabelEmailManager::ON_BORDEREAU_GENERATION_OPTION === $email_outward_label) {
                    do_action(
                        'lpc_outward_label_generated_to_email',
                        ['order' => $order]
                    );
                }
            }
        }

        if (1 === count($trackingNumbersPerBatch)) {
            // when only 1 bordereau is generated, we return it
            return $this->bordereauGenerationApi->getBordereauByNumber($bordereauId)->bordereau;
        }
    }

    protected function prepareBatch(array $parcelNumbers) {
        return array_chunk($parcelNumbers, self::MAX_LABEL_PER_BORDEREAU, true);
    }
}
