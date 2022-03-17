<?php

class LpcLabelPurge extends LpcComponent {

    /** @var LpcInwardLabelDb */
    protected $inwardLabelDb;
    /** @var LpcOutwardLabelDb */
    protected $outwardLabelDb;

    public function __construct(LpcInwardLabelDb $inwardLabelDb = null, LpcOutwardLabelDb $outwardLabelDb = null) {
        $this->inwardLabelDb  = LpcRegister::get('inwardLabelDb', $inwardLabelDb);
        $this->outwardLabelDb = LpcRegister::get('outwardLabelDb', $outwardLabelDb);
    }

    public function getDependencies() {
        return ['inwardLabelDb', 'outwardLabelDb'];
    }

    public function purgeReadyLabels() {
        $nbDays = LpcHelper::get_option('lpc_day_purge', 0);

        if ('0' == $nbDays) {
            return;
        }

        $matchingOrdersId = LpcOrderQueries::getLpcOrdersIdsForPurge();

        foreach ($matchingOrdersId as $orderId) {

            LpcLogger::debug(
                __METHOD__ . ' purge labels for',
                [
                    'orderId' => $orderId,
                ]
            );

            $this->inwardLabelDb->purgeLabelsByOrderId($orderId);
            $this->outwardLabelDb->purgeLabelsByOrderId($orderId);
        }
    }
}
