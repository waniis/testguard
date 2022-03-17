<?php

class LpcLabelQueries extends LpcComponent {

    const REDIRECTION_WOO_ORDER_EDIT_PAGE = 'lpc_woocommerce_order_edit_page';
    const REDIRECTION_COLISSIMO_ORDERS_LISTING = 'lpc_colissimo_orders_listing';

    /** @var LpcInwardLabelDb */
    protected $inwardLabelDb;
    /** @var LpcOutwardLabelDb */
    protected $outwardLabelDb;
    /** @var LpcLabelOutwardDeleteAction */
    protected $labelOutwardDeleteAction;
    /** @var LpcLabelInwardDeleteAction */
    protected $labelInwardDeleteAction;
    /** @var LpcLabelPackagerDownloadAction */
    protected $labelPackagerDownloadAction;
    /** @var LpcLabelOutwardDownloadAction */
    protected $labelOutwardDownloadAction;
    /** @var LpcLabelInwardDownloadAction */
    protected $labelInwardDownloadAction;
    /** @var LpcLabelPrintAction */
    protected $labelPrintAction;
    /** @var LpcInwardLabelEmailManager */
    protected $inwardLabelEmailManager;

    public function __construct(
        LpcInwardLabelDb $inwardLabelDb = null,
        LpcOutwardLabelDb $outwardLabelDb = null,
        LpcLabelOutwardDeleteAction $labelOutwardDeleteAction = null,
        LpcLabelInwardDeleteAction $labelInwardDeleteAction = null,
        LpcLabelPackagerDownloadAction $labelPackagerDownloadAction = null,
        LpcLabelOutwardDownloadAction $labelOutwardDownloadAction = null,
        LpcLabelInwardDownloadAction $labelInwardDownloadAction = null,
        LpcLabelPrintAction $labelPrintAction = null,
        LpcInwardLabelEmailManager $inwardLabelEmailManager = null
    ) {
        $this->inwardLabelDb               = LpcRegister::get('inwardLabelDb', $inwardLabelDb);
        $this->outwardLabelDb              = LpcRegister::get('outwardLabelDb', $outwardLabelDb);
        $this->labelOutwardDeleteAction    = LpcRegister::get('labelOutwardDeleteAction', $labelOutwardDeleteAction);
        $this->labelInwardDeleteAction     = LpcRegister::get('labelInwardDeleteAction', $labelInwardDeleteAction);
        $this->labelPackagerDownloadAction = LpcRegister::get('labelPackagerDownloadAction', $labelPackagerDownloadAction);
        $this->labelOutwardDownloadAction  = LpcRegister::get('labelOutwardDownloadAction', $labelOutwardDownloadAction);
        $this->labelInwardDownloadAction   = LpcRegister::get('labelInwardDownloadAction', $labelInwardDownloadAction);
        $this->labelPrintAction            = LpcRegister::get('labelPrintAction', $labelPrintAction);
        $this->inwardLabelEmailManager     = LpcRegister::get('lpcInwardLabelEmailManager', $inwardLabelEmailManager);
    }

    /**
     * Retrieve an associative array where keys are order id, and values are matching tracking numbers.
     * Each tracking numbers are array where keys are outward tracking number, and values are array of inward tracking numbers
     *
     * @param       $trackingNumbersByOrders
     * @param       $labelFormatByTrackingNumber
     * @param array $ordersId
     */
    public function getTrackingNumbersByOrdersId(
        &$trackingNumbersByOrders,
        &$labelFormatByTrackingNumber,
        $ordersId = []
    ) {
        $outwardTrackingNumbers = $this->outwardLabelDb->getLabelsInfosForOrdersId($ordersId);
        $inwardTrackingNumbers  = $this->inwardLabelDb->getLabelsInfosForOrdersId($ordersId);

        foreach ($outwardTrackingNumbers as $oneOutwardTrackingNumber) {
            if (!empty($oneOutwardTrackingNumber->tracking_number)) {
                $trackingNumbersByOrders[$oneOutwardTrackingNumber->order_id][$oneOutwardTrackingNumber->tracking_number] = [];

                $labelFormatByTrackingNumber[$oneOutwardTrackingNumber->tracking_number] =
                    !empty($oneOutwardTrackingNumber->label_format)
                        ? $oneOutwardTrackingNumber->label_format
                        : LpcLabelGenerationPayload::LABEL_FORMAT_PDF;
            }
        }

        foreach ($inwardTrackingNumbers as $oneInwardTrackingNumber) {
            if (!empty($oneInwardTrackingNumber->tracking_number)) {
                if (
                    !empty($oneInwardTrackingNumber->outward_tracking_number)
                    && isset($trackingNumbersByOrders[$oneInwardTrackingNumber->order_id][$oneInwardTrackingNumber->outward_tracking_number])
                ) {
                    $trackingNumbersByOrders[$oneInwardTrackingNumber->order_id][$oneInwardTrackingNumber->outward_tracking_number][] = $oneInwardTrackingNumber->tracking_number;
                } else {
                    $trackingNumbersByOrders[$oneInwardTrackingNumber->order_id]['no_outward'][] = $oneInwardTrackingNumber->tracking_number;
                }

                $labelFormatByTrackingNumber[$oneInwardTrackingNumber->tracking_number] =
                    !empty($oneInwardTrackingNumber->label_format)
                        ? $oneInwardTrackingNumber->label_format
                        : LpcLabelGenerationPayload::LABEL_FORMAT_PDF;
            }
        }
    }

    /**
     * Retrieve an array containing all tracking numbers for orders ids in param
     *
     * @param array  $ordersId
     * @param string $labelType
     *
     * @return array
     */
    public function getTrackingNumbersForOrdersId(
        $ordersId = [],
        $labelType = LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD
    ) {
        $trackingNumbers = [];

        if (LpcOutwardLabelDb::LABEL_TYPE_OUTWARD === $labelType || LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD === $labelType) {
            $outwardTrackingNumbers = $this->outwardLabelDb->getLabelsInfosForOrdersId($ordersId);
            foreach ($outwardTrackingNumbers as $oneOutTrackingNumber) {
                if (!empty($oneOutTrackingNumber->tracking_number)) {
                    $trackingNumbers[] = $oneOutTrackingNumber->tracking_number;
                }
            }
        }

        if (LpcInwardLabelDb::LABEL_TYPE_INWARD === $labelType || LpcLabelPrintAction::PRINT_LABEL_TYPE_OUTWARD_AND_INWARD === $labelType) {
            $inwardTrackingNumbers = $this->inwardLabelDb->getLabelsInfosForOrdersId($ordersId);
            foreach ($inwardTrackingNumbers as $oneInTrackingNumber) {
                if (!empty($oneInTrackingNumber->tracking_number)) {
                    $trackingNumbers[] = $oneInTrackingNumber->tracking_number;
                }
            }
        }

        return $trackingNumbers;
    }

    public function getOutwardLabelsActionsIcons($trackingNumber, $format, $redirection) {
        $printerIcon = $GLOBALS['wp_version'] >= '5.5' ? 'dashicons-printer' : 'dashicons-media-default';

        return '<span class="dashicons dashicons-download lpc_label_action_download" ' .
               $this->getLabelOutwardDownloadAttr($trackingNumber, $format) . '></span>'
               . '<span class="dashicons ' . $printerIcon . ' lpc_label_action_print" ' .
               $this->getLabelOutwardPrintAttr($trackingNumber, $format) . ' ></span>'
               . '<span class="dashicons dashicons-trash lpc_label_action_delete" ' . $this->getLabelOutwardDeletionAttr($trackingNumber, $redirection) . '></span>';
    }

    public function getInwardLabelsActionsIcons($trackingNumber, $format, $redirection) {
        $printerIcon = $GLOBALS['wp_version'] >= '5.5' ? 'dashicons-printer' : 'dashicons-media-default';

        return '<span class="dashicons dashicons-email-alt lpc_label_action_send_email" ' . $this->getLabelInwardSendAttr($trackingNumber, $redirection) . '></span>'
               . '<span class="dashicons dashicons-download lpc_label_action_download" ' .
               $this->getLabelInwardDownloadAttr($trackingNumber, $format) . '></span>'
               . '<span class="dashicons ' . $printerIcon . ' lpc_label_action_print" ' .
               $this->getLabelInwardPrintAttr($trackingNumber, $format) . '></span>'
               . '<span class="dashicons dashicons-trash lpc_label_action_delete" ' . $this->getLabelInwardDeletionAttr($trackingNumber, $redirection) . '></span>';
    }

    protected function getLabelOutwardDeletionAttr($trackingNumber, $redirection) {
        return 'data-link="' . $this->labelOutwardDeleteAction->getUrlForTrackingNumber($trackingNumber, $redirection) . '" '
               . 'data-label-type="' . LpcOutwardLabelDb::LABEL_TYPE_OUTWARD . '" '
               . 'data-tracking-number="' . $trackingNumber . '" '
               . 'title="' . __('Delete outward label', 'wc_colissimo') . '"';
    }

    protected function getLabelInwardDeletionAttr($trackingNumber, $redirection) {
        return 'data-link="' . $this->labelInwardDeleteAction->getUrlForTrackingNumber($trackingNumber, $redirection) . '" '
               . ' data-label-type="' . LpcInwardLabelDb::LABEL_TYPE_INWARD . '" '
               . 'data-tracking-number="' . $trackingNumber . '" '
               . 'title="' . __('Delete inward label', 'wc_colissimo') . '"';
    }

    protected function getLabelOutwardDownloadAttr($trackingNumber, $format) {
        switch ($format) {
            case LpcLabelGenerationPayload::LABEL_FORMAT_ZPL:
            case LpcLabelGenerationPayload::LABEL_FORMAT_DPL:
                $outwardLabelDownloadLink = $this->labelPackagerDownloadAction->getUrlForTrackingNumbers(
                    [$trackingNumber]
                );
                break;
            case LpcLabelGenerationPayload::LABEL_FORMAT_PDF:
            default:
                $outwardLabelDownloadLink = $this->labelOutwardDownloadAction->getUrlForTrackingNumber($trackingNumber);
                break;
        }

        return 'data-link="' . $outwardLabelDownloadLink . '" title="' . __(
                'Download outward label',
                'wc_colissimo'
            ) . '"';
    }

    protected function getLabelInwardDownloadAttr($trackingNumber, $format) {
        switch ($format) {
            case LpcLabelGenerationPayload::LABEL_FORMAT_ZPL:
            case LpcLabelGenerationPayload::LABEL_FORMAT_DPL:
                $inwardLabelDownloadLink = $this->labelPackagerDownloadAction->getUrlForTrackingNumbers(
                    [$trackingNumber]
                );
                break;
            case LpcLabelGenerationPayload::LABEL_FORMAT_PDF:
            default:
                $inwardLabelDownloadLink = $this->labelInwardDownloadAction->getUrlForTrackingNumber($trackingNumber);
                break;
        }

        return 'data-link="' . $inwardLabelDownloadLink . '" title="' . __(
                'Download inward label',
                'wc_colissimo'
            ) . '"';
    }

    protected function getLabelOutwardPrintAttr($trackingNumber, $format) {
        return 'data-link="' . $this->labelPrintAction->getUrlForTrackingNumbers(
                [$trackingNumber],
                false
            ) . '" data-label-type="' . LpcOutwardLabelDb::LABEL_TYPE_OUTWARD . '" '
               . 'data-tracking-number="' . $trackingNumber . '" '
               . 'data-format="' . $format . '" '
               . 'title="' . __('Print outward label', 'wc_colissimo') . '"';
    }

    protected function getLabelInwardPrintAttr($trackingNumber, $format) {
        return 'data-link="' . $this->labelPrintAction->getUrlForTrackingNumbers(
                [$trackingNumber],
                false
            ) . '" data-label-type="' . LpcInwardLabelDb::LABEL_TYPE_INWARD . '" '
               . 'data-tracking-number="' . $trackingNumber . '" '
               . 'data-format="' . $format . '" '
               . 'title="' . __('Print inward label', 'wc_colissimo') . '"';
    }

    protected function getLabelInwardSendAttr($trackingNumber, $redirection) {
        return 'data-link="' . $this->inwardLabelEmailManager->labelEmailingUrl($trackingNumber, $redirection) . '" '
               . 'title="' . __('Email Return Label', 'wc_colissimo') . '"';
    }

    public static function enqueueLabelsActionsScript() {
        $thermalLabelPrintAction            = LpcRegister::get('thermalLabelPrintAction');
        $args['errorMsgPrintThermal']       = __('Print thermal error on some orders. Please check browser console for more information', 'wc_colissimo');
        $args['deletionConfirmTextOutward'] = __('Do you confirm the deletion of label? All related inwards label will be deleted too', 'wc_colissimo');
        $args['deletionConfirmTextInward']  = __('Do you confirm the deletion of label?', 'wc_colissimo');
        $args['thermalLabelPrintActionUrl'] = $thermalLabelPrintAction->getThermalPrintActionUrl();

        LpcHelper::enqueueScript(
            'lpc_labels_actions',
            plugins_url('/js/labels/lpc_labels_actions.js', LPC_ADMIN . 'init.php'),
            null,
            ['jquery-core'],
            'lpcLabelsActions',
            $args
        );
    }
}
