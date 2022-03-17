<?php

class LpcLabelGenerationPayload {
    const MAX_INSURANCE_AMOUNT = 5000;
    const MAX_INSURANCE_AMOUNT_RELAY = 1000;
    const FORCED_ORIGINAL_IDENT = 'A';
    const RETURN_LABEL_LETTER_MARK = 'R';
    const RETURN_TYPE_CHOICE_NO_RETURN = 3;
    const PRODUCT_CODE_INSURANCE_AVAILABLE = ['DOS', 'COL', 'BPR', 'A2P', 'CDS', 'CORE', 'CORI', 'COLI'];
    const CUSTOMS_CATEGORY_RETURN_OF_ARTICLES = 6;
    const LABEL_FORMAT_PDF = 'PDF';
    const LABEL_FORMAT_ZPL = 'ZPL';
    const LABEL_FORMAT_DPL = 'DPL';
    const LABEL_FORMATS = [self::LABEL_FORMAT_PDF, self::LABEL_FORMAT_ZPL, self::LABEL_FORMAT_DPL];

    protected $payload;
    protected $isReturnLabel;
    protected $capabilitiesPerCountry;
    protected $orderNumber;

    public function __construct(
        LpcCapabilitiesPerCountry $capabilitiesPerCountry = null
    ) {
        $this->capabilitiesPerCountry = LpcRegister::get('capabilitiesPerCountry', $capabilitiesPerCountry);

        $this->payload = [
            'letter' => [
                'service' => [],
                'parcel'  => [],
            ],
        ];

        $this->isReturnLabel = false;
    }

    public function withSender(array $sender = null) {
        if (null === $sender) {
            $sender = $this->getStoreAddress();
        }

        $payloadSender = [
            'companyName' => @$sender['companyName'],
            'firstName'   => @$sender['firstName'],
            'lastName'    => @$sender['lastName'],
            'line2'       => @$sender['street'],
            'countryCode' => $sender['countryCode'],
            'city'        => $sender['city'],
            'zipCode'     => $sender['zipCode'],
            'email'       => @$sender['email'],
        ];

        if (!empty($sender['street2'])) {
            $payloadSender['address']['line3'] = $sender['street2'];
        }

        $payloadSender = apply_filters('lpc_payload_letter_sender', $payloadSender, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['letter']['sender']['address'] = $payloadSender;

        return $this;
    }

    public function withCommercialName($commercialName = null) {
        $commercialName = apply_filters('lpc_payload_letter_service_commercial_name', $commercialName, $this->getOrderNumber(), $this->getIsReturnLabel());

        if (empty($commercialName)) {
            unset($this->payload['letter']['service']['commercialName']);
        } else {
            $this->payload['letter']['service']['commercialName'] = $commercialName;
        }

        return $this;
    }

    public function withContractNumber($contractNumber = null) {
        if (null === $contractNumber) {
            $contractNumber = LpcHelper::get_option('lpc_id_webservices');
        }

        $contractNumber = apply_filters('lpc_payload_contract_number', $contractNumber, $this->getOrderNumber(), $this->getIsReturnLabel());

        if (empty($contractNumber)) {
            unset($this->payload['contractNumber']);
        } else {
            $this->payload['contractNumber'] = $contractNumber;
        }

        return $this;
    }

    public function withPassword($password = null) {
        if (null === $password) {
            $password = LpcHelper::get_option('lpc_pwd_webservices');
        }

        if (empty($password)) {
            unset($this->payload['password']);
        } else {
            $this->payload['password'] = $password;
        }

        return $this;
    }

    public function withAddressee(array $addressee) {
        $payloadAddressee = [
            'address' => [
                'companyName' => @$addressee['companyName'],
                'firstName'   => @$addressee['firstName'],
                'lastName'    => @$addressee['lastName'],
                'line2'       => $addressee['street'],
                'countryCode' => $addressee['countryCode'],
                'city'        => $addressee['city'],
                'zipCode'     => $addressee['zipCode'],
                'email'       => @$addressee['email'],
            ],
        ];

        if (!empty($addressee['mobileNumber'])) {
            $this->setAddresseePhoneNumber($payloadAddressee, $addressee['mobileNumber'], $addressee['countryCode']);
        }

        $this->setFtdGivenCountryCodeId($addressee['countryCode']);

        if (!empty($addressee['street2'])) {

            // Required bypass because Colissimo Labels for Belgium or Switzerland don't display line3
            $countryCodesNoLine3 = ['BE', 'CH'];
            if (in_array($addressee['countryCode'], $countryCodesNoLine3)) {
                $payloadAddressee['address']['line2'] = $payloadAddressee['address']['line2'] . ' ' . $addressee['street2'];
            } else {
                $payloadAddressee['address']['line3'] = $addressee['street2'];
            }
        }

        $payloadAddressee = apply_filters('lpc_payload_letter_addressee', $payloadAddressee, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['letter']['addressee'] = $payloadAddressee;

        return $this;
    }

    public function withPackage(WC_Order $order, $customParams = []) {
        if (isset($customParams['totalWeight'])) {
            $totalWeight = wc_get_weight($customParams['totalWeight'], 'kg');
        } else {
            $totalWeight = 0;
            foreach ($order->get_items() as $item) {
                $data          = $item->get_data();
                $product       = $item->get_product();
                $productWeight = $product->get_weight() < 0.01 ? 0.01 : $product->get_weight();
                $weight        = (float) $productWeight * $data['quantity'];

                if ($weight < 0) {
                    throw new \Exception(
                        __('Weight cannot be negative!', 'wc_colissimo')
                    );
                }

                $weightInKg  = wc_get_weight($weight, 'kg');
                $totalWeight += $weightInKg;
            }

            $packagingWeight = wc_get_weight(LpcHelper::get_option('lpc_packaging_weight', '0'), 'kg');
            $totalWeight     += $packagingWeight;
        }

        if ($totalWeight < 0.01) {
            $totalWeight = 0.01;
        }

        $totalWeight = number_format($totalWeight, 2);

        $totalWeight = apply_filters('lpc_payload_letter_parcel_weight', $totalWeight, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['letter']['parcel']['weight'] = (string) $totalWeight;

        return $this;
    }

    public function withPickupLocationId($pickupLocationId) {
        $pickupLocationId = apply_filters('lpc_payload_letter_parcel_pickup_location_id', $pickupLocationId, $this->getOrderNumber(), $this->getIsReturnLabel());

        if (null === $pickupLocationId) {
            unset($this->payload['letter']['parcel']['pickupLocationId']);
        } else {
            $this->payload['letter']['parcel']['pickupLocationId'] = $pickupLocationId;
        }

        return $this;
    }

    public function withProductCode($productCode) {
        $allowedProductCodes = [
            'A2P',
            'ACCI',
            'BDP',
            'BPR',
            'CDS',
            'CMT',
            'COL',
            'COLD',
            'COLI',
            'COM',
            'CORE',
            'CORI',
            'DOM',
            'DOS',
            'ECO',
        ];

        $productCode = apply_filters('lpc_payload_letter_service_product_code', $productCode, $this->getOrderNumber(), $this->getIsReturnLabel());

        if (!in_array($productCode, $allowedProductCodes)) {
            LpcLogger::error(
                'Unknown productCode',
                [
                    'given' => $productCode,
                    'known' => $allowedProductCodes,
                ]
            );
            throw new \Exception('Unknown Product code!');
        }

        $this->payload['letter']['service']['productCode'] = $productCode;

        $this->payload['letter']['service']['returnTypeChoice'] = self::RETURN_TYPE_CHOICE_NO_RETURN;

        return $this;
    }

    protected function setFtdGivenCountryCodeId($destinationCountryId) {
        if (LpcHelper::get_option('lpc_customs_isFtd') === 'yes' && $this->capabilitiesPerCountry->getFtdRequiredForDestination($destinationCountryId) === true) {
            $this->payload['letter']['parcel']['ftd'] = true;
        } else {
            unset($this->payload['letter']['parcel']['ftd']);
        }
    }

    public function withDepositDate(\DateTime $depositDate) {
        $now         = new \DateTime();
        $depositDate = apply_filters('lpc_payload_letter_service_deposit_date', $depositDate, $this->getOrderNumber(), $this->getIsReturnLabel());

        if ($depositDate->getTimestamp() < $now->getTimestamp()) {
            LpcLogger::warn(
                'Given DepositDate is in the past, using today instead.',
                [
                    'given' => $depositDate,
                    'now'   => $now,
                ]
            );
            $depositDate = $now;
        }

        $this->payload['letter']['service']['depositDate'] = $depositDate->format('Y-m-d');

        return $this;
    }

    public function withPreparationDelay($delay = null) {
        if (null === $delay) {
            $delay = LpcHelper::get_option('lpc_preparation_time');
        }

        $delay = apply_filters('lpc_payload_delay', $delay, $this->getOrderNumber(), $this->getIsReturnLabel());

        $depositDate = new \DateTime();

        $delay = (int) $delay;
        if ($delay > 0) {
            $depositDate->add(new \DateInterval("P{$delay}D"));
        } else {
            LpcLogger::warn(
                'Preparation delay was not applied because it was negative or zero!',
                ['given' => $delay]
            );
        }

        return $this->withDepositDate($depositDate);
    }

    public function withOutputFormat($outputFormat = null) {
        if (null === $outputFormat) {
            $outputFormat = $this->getIsReturnLabel()
                ? LpcHelper::get_option('lpc_returnLabelFormat')
                : LpcHelper::get_option('lpc_deliveryLabelFormat');
        }

        $outputFormat = apply_filters('lpc_payload_output_format', $outputFormat, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['outputFormat'] = [
            'x'                  => 0,
            'y'                  => 0,
            'outputPrintingType' => $outputFormat,
        ];

        return $this;
    }

    public function withOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;

        $orderNumber = apply_filters('lpc_payload_letter_service_order_number', $orderNumber, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['letter']['service']['orderNumber']    = $orderNumber;
        $this->payload['letter']['sender']['senderParcelRef'] = $orderNumber;

        return $this;
    }

    public function withInsuranceValue($amount, $productCode, $countryCode) {
        $usingInsurance = LpcHelper::get_option('lpc_using_insurance', 'no');

        $usingInsurance = apply_filters('lpc_payload_letter_parcel_using_insurance', $usingInsurance, $this->getOrderNumber(), $this->getIsReturnLabel());

        if ('yes' !== $usingInsurance || !in_array($productCode, self::PRODUCT_CODE_INSURANCE_AVAILABLE) || ('DOS' == $productCode && 'FR' !== $countryCode)) {
            return $this;
        }

        $amount             = (float) apply_filters('lpc_payload_letter_parcel_insurance_value', $amount, $this->getOrderNumber(), $this->getIsReturnLabel());
        $maxInsuranceAmount = $this->getMaxInsuranceAmountByProductCode($productCode);

        if ($amount > $maxInsuranceAmount) {
            LpcLogger::warn(
                'Given insurance value amount is too big, forced to ' . $maxInsuranceAmount,
                [
                    'given' => $amount,
                    'max'   => $maxInsuranceAmount,
                ]
            );

            $amount = $maxInsuranceAmount;
        }

        if ($amount > 0) {
            // payload want centi-euros for this field.
            $this->payload['letter']['parcel']['insuranceValue'] = (int) ($amount * 100);
        } else {
            LpcLogger::warn(
                'Insurance value was not applied because it was negative or zero!',
                [
                    'given' => $amount,
                ]
            );
        }

        return $this;
    }

    public function withCODAmount($amount) {
        $amount = (float) apply_filters('lpc_payload_letter_parcel_cod', $amount, $this->getOrderNumber(), $this->getIsReturnLabel());

        if ($amount > 0) {
            $this->payload['letter']['parcel']['COD'] = true;
            // payload want centi-euros for this field.
            $this->payload['letter']['parcel']['CODAmount'] = (int) ($amount * 100);
        } else {
            LpcLogger::warn(
                'CODAmount was not applied because it was negative or zero!',
                [
                    'given' => $amount,
                ]
            );
        }

        return $this;
    }

    public function withReturnReceipt($value = true) {
        $value = apply_filters('lpc_payload_letter_parcel_return_receipt', $value, $this->getOrderNumber(), $this->getIsReturnLabel());

        if ($value) {
            $this->payload['letter']['parcel']['returnReceipt'] = true;
        } else {
            unset($this->payload['letter']['parcel']['returnReceipt']);
        }

        return $this;
    }

    public function withInstructions($instructions) {
        if (LpcHelper::get_option('lpc_add_customer_notes', 'no') === 'no') {
            return $this;
        }

        $instructions = apply_filters('lpc_payload_letter_parcel_instructions', $instructions, $this->getOrderNumber(), $this->getIsReturnLabel());

        if (empty($instructions)) {
            unset($this->payload['letter']['parcel']['instructions']);
        } else {
            $this->payload['letter']['parcel']['instructions'] = preg_replace('/[^A-Za-z0-9 ]/', '', $instructions);
        }

        return $this;
    }

    public function withCuserInfoText($info = null) {
        if (null === $info) {
            global $woocommerce;

            $woocommerceVersion = $woocommerce->version;
            $pluginData         = get_plugin_data(LPC_FOLDER . DS . 'index.php', false, false);
            $colissimoVersion   = $pluginData['Version'];

            $info = 'WC' . $woocommerceVersion . ';' . $colissimoVersion;
        }

        $customFields = [
            'key'   => 'CUSER_INFO_TEXT',
            'value' => $info,
        ];

        $this->payload['fields']['customField'][] = $customFields;

        return $this;
    }

    public function withCustomsDeclaration(WC_Order $order, $destinationCountryId, $customParams = []) {

        // No need details if no CN23 required
        if (!$this->capabilitiesPerCountry->getIsCn23RequiredForDestination($destinationCountryId)) {
            return $this;
        }

        $isCustomItems    = isset($customParams['items']);
        $customsArticles  = [];
        $totalItemsAmount = 0;

        foreach ($order->get_items() as $item) {
            if ($isCustomItems && !isset($customParams['items'][$item->get_id()])) {
                continue;
            }

            $product = $item->get_product();

            $quantity = isset($customParams['items'][$item->get_id()]['qty']) ? $customParams['items'][$item->get_id()]['qty'] : $item->get_quantity();

            if (isset($customParams['items'][$item->get_id()]['price'])) {
                $unitaryValue = $customParams['items'][$item->get_id()]['price'];
            } else {
                $unitaryValue = empty($item->get_quantity()) ? 1 : $item->get_total() / $item->get_quantity();
            }

            $totalItemsAmount += $unitaryValue * $quantity;

            $customsArticle = [
                'description'   => substr($item->get_name(), 0, 64),
                'quantity'      => $quantity,
                'value'         => (string) round($unitaryValue, 2),
                'currency'      => $order->get_currency(),
                'artref'        => substr($product->get_sku(), 0, 44),
                'originalIdent' => self::FORCED_ORIGINAL_IDENT,
                'originCountry' => $this->getProductOriginCountry($product),
                'hsCode'        => $this->getProductHsCode($product),
            ];

            $itemWeight         = isset($customParams['items'][$item->get_id()]['weight']) ? $customParams['items'][$item->get_id()]['weight'] : $product->get_weight();
            $itemWeightWellUnit = wc_get_weight($itemWeight, 'kg');

            $customsArticle['weight'] = $itemWeightWellUnit < 0.01 ? '0.01' : (string) $itemWeightWellUnit;

            $customsArticles[] = $customsArticle;
        }

        $customsDeclarationPayload = [
            'includeCustomsDeclarations' => 1,
            'contents'                   => [
                'article'  => $customsArticles,
                'category' => [
                    'value' => $this->isReturnLabel ? self::CUSTOMS_CATEGORY_RETURN_OF_ARTICLES : LpcHelper::get_option('lpc_customs_defaultCustomsCategory'),
                ],
            ],
            'invoiceNumber'              => $order->get_order_number(),
        ];

        if ('GB' === $destinationCountryId && !$this->isReturnLabel) {
            $vatNumber = LpcHelper::get_option('lpc_vat_number', 0);

            if (0 === $vatNumber) {
                LpcLogger::warn('No VAT number set in config');
            } else {
                $customsDeclarationPayload['comments'] = 'N. TVA : ' . $vatNumber;
            }
        }

        if ($this->getIsReturnLabel()) {
            $originalInvoiceDate = $order->get_date_created()
                                         ->date('Y-m-d');

            $originalParcelNumber = $this->getOriginalParcelNumberFromInvoice($order);

            $customsDeclarationPayload['contents']['original'] =
                [
                    [
                        'originalIdent'         => self::FORCED_ORIGINAL_IDENT,
                        'originalInvoiceNumber' => $order->get_order_number(),
                        'originalInvoiceDate'   => $originalInvoiceDate,
                        'originalParcelNumber'  => $originalParcelNumber,
                    ],
                ];
        }

        $customsDeclarationPayload = apply_filters('lpc_payload_letter_customs_declarations', $customsDeclarationPayload, $this->getOrderNumber(), $this->getIsReturnLabel());

        $this->payload['letter']['customsDeclarations'] = $customsDeclarationPayload;

        $shippingCosts = isset($customParams['shippingCosts']) ? $customParams['shippingCosts'] : $order->get_shipping_total();

        $transportationAmount = apply_filters('lpc_payload_letter_service_total_amount', $shippingCosts, $this->getOrderNumber(), $this->getIsReturnLabel());

        // payload want centi-currency for these fields.
        $this->payload['letter']['service']['totalAmount']          = (int) ($transportationAmount * 100);
        $this->payload['letter']['service']['transportationAmount'] = (int) ($transportationAmount * 100);

        if ('GB' === $destinationCountryId) {
            $eoriNumber = LpcHelper::get_option('lpc_eori_uk_number');
            if ($totalItemsAmount >= 1000) {
                $eoriNumber .= ' ' . LpcHelper::get_option('lpc_eori_number');
            }
        } else {
            $eoriNumber = LpcHelper::get_option('lpc_eori_number');
        }

        $eoriNumber = apply_filters('lpc_payload_eori_number', $eoriNumber, $this->getOrderNumber(), $this->getIsReturnLabel());

        $eoriFields = [
            'key'   => 'EORI',
            'value' => $eoriNumber,
        ];

        $this->payload['fields']['customField'][] = $eoriFields;

        return $this;
    }

    /** Set phone number or mobile number depend on formatting and country
     *
     * @param        $payloadAddress
     * @param        $phoneNumber
     * @param string $countryCode
     */
    protected function setAddresseePhoneNumber(&$payloadAddress, $phoneNumber, $countryCode = 'FR') {
        if (empty($phoneNumber)) {
            return;
        }

        $phoneNumber              = str_replace(' ', '', $phoneNumber);
        $frenchMobileNumberRegex  = '/^(?:(?:\+|00)33|0)(?:6|7)\d{8}$/';
        $belgianMobileNumberRegex = '/^(?:(?:\+|00)32|0)4\d{8}$/';

        if (preg_match($frenchMobileNumberRegex, $phoneNumber) && 'FR' === $countryCode) {
            $payloadAddress['address']['mobileNumber'] = $phoneNumber;
        } elseif (preg_match($belgianMobileNumberRegex, $phoneNumber) && 'BE' === $countryCode) {
            $phoneNumber                               = preg_replace('/(04)([0-9]{8})/', '+324$2', $phoneNumber);
            $payloadAddress['address']['mobileNumber'] = $phoneNumber;
        } else {
            $payloadAddress['address']['phoneNumber'] = $phoneNumber;
        }
    }

    /**
     * Retrieve product Origin Country
     *
     * @param $product
     *
     * @return string
     */
    protected function getProductOriginCountry($product) {
        $countryOfManufactureFieldName = LpcHelper::get_option('lpc_customs_countryOfManufactureFieldName');
        $countryOfManufacture          = $product->get_attribute($countryOfManufactureFieldName);

        if (!empty($countryOfManufacture)) {
            return $countryOfManufacture;
        }

        // If empty, we check is the parent product has the attribute (for variable product)
        $parentProduct = wc_get_product($product->get_parent_id());

        if (!empty($parentProduct)) {
            $countryOfManufacture = $parentProduct->get_attribute($countryOfManufactureFieldName);

            if (!empty($countryOfManufacture)) {
                return $countryOfManufacture;
            }
        }

        return '';
    }

    /**
     * Retrieve product HS code
     *
     * @param $product
     *
     * @return array|string
     */
    protected function getProductHsCode($product) {
        $defaultHsCode   = LpcHelper::get_option('lpc_customs_defaultHsCode');
        $hsCodeFieldName = LpcHelper::get_option('lpc_customs_hsCodeFieldName');
        $hsCode          = $product->get_attribute($hsCodeFieldName);

        if (!empty($hsCode)) {
            return $hsCode;
        }

        // If empty, we check is the parent product has the attribute (for variable product)
        $parentProduct = wc_get_product($product->get_parent_id());

        if (!empty($parentProduct)) {
            $hsCode = $parentProduct->get_attribute($hsCodeFieldName);

            if (!empty($hsCode)) {
                return $hsCode;
            }
        }

        // Set default HS code if not defined on the product
        return $defaultHsCode;
    }

    public function isReturnLabel($isReturnLabel = true) {
        $this->isReturnLabel = $isReturnLabel;

        return $this;
    }

    public function getIsReturnLabel() {
        return $this->isReturnLabel;
    }

    public function checkConsistency() {
        $this->checkPickupLocationId();
        $this->checkCommercialName();

        if (!$this->getIsReturnLabel()) {
            $this->checkSenderAddress();
            $this->checkAddresseeAddress();
        }

        return $this;
    }

    public function assemble() {
        return array_merge($this->payload); // makes a copy
    }

    /**
     * Retrieve payload without password for log
     *
     * @return array
     */
    public function getPayloadWithoutPassword() {
        $payloadWithoutPass = $this->payload;
        unset($payloadWithoutPass['password']);

        return $payloadWithoutPass;
    }

    protected function checkPickupLocationId() {
        $productCodesNeedingPickupLocationIdSet = [
            'A2P',
            'BPR',
            'ACP',
            'CDI',
            'CMT',
            'BDP',
            'PCS',
        ];

        if (in_array($this->payload['letter']['service']['productCode'], $productCodesNeedingPickupLocationIdSet)
            && (!isset($this->payload['letter']['parcel']['pickupLocationId'])
                || empty($this->payload['letter']['parcel']['pickupLocationId']))) {
            throw new Exception(
                __('The ProductCode used requires that a pickupLocationId is set!', 'wc_colissimo')
            );
        }

        if (!in_array($this->payload['letter']['service']['productCode'], $productCodesNeedingPickupLocationIdSet)
            && isset($this->payload['letter']['parcel']['pickupLocationId'])) {
            throw new Exception(
                __('The ProductCode used requires that a pickupLocationId is *not* set!', 'wc_colissimo')
            );
        }
    }

    protected function checkCommercialName() {
        $productCodesNeedingCommercialName = [
            'A2P',
            'BPR',
        ];

        if (in_array($this->payload['letter']['service']['productCode'], $productCodesNeedingCommercialName)
            && (!isset($this->payload['letter']['service']['commercialName'])
                || empty($this->payload['letter']['service']['commercialName']))) {
            throw new Exception(
                __('The ProductCode used requires that a commercialName is set!', 'wc_colissimo')
            );
        }
    }

    protected function checkSenderAddress() {
        $address = $this->payload['letter']['sender']['address'];

        if (empty($address['companyName'])) {
            throw new Exception(
                __('companyName must be set in Sender address!', 'wc_colissimo')
            );
        }

        if (empty($address['line2'])) {
            throw new Exception(
                __('line2 must be set in Sender address!', 'wc_colissimo')
            );
        }

        if (empty($address['countryCode'])) {
            throw new Exception(
                __('countryCode must be set in Sender address!', 'wc_colissimo')
            );
        }

        if (empty($address['zipCode'])) {
            throw new Exception(
                __('zipCode must be set in Sender address!', 'wc_colissimo')
            );
        }

        if (empty($address['city'])) {
            throw new Exception(
                __('city must be set in Sender address!', 'wc_colissimo')
            );
        }
    }

    protected function checkAddresseeAddress() {
        $productCodesNeedingMobileNumber = [
            'A2P',
            'BPR',
        ];

        $address = $this->payload['letter']['addressee']['address'];

        if (empty($address['companyName'])
            && (empty($address['firstName']) || empty($address['lastName']))
        ) {
            throw new Exception(
                __('companyName or (firstName + lastName) must be set in Addressee address!', 'wc_colissimo')
            );
        }

        if ($this->isReturnLabel) {
            if (empty($address['companyName'])) {
                throw new \Exception(
                    __('companyName must be set in Addressee address for return label!', 'wc_colissimo')
                );
            }
        }

        if (empty($address['line2'])) {
            throw new \Exception(
                __('line2 must be set in Addressee address!', 'wc_colissimo')
            );
        }

        if (empty($address['countryCode'])) {
            throw new \Exception(
                __('countryCode must be set in Addressee address!', 'wc_colissimo')
            );
        }

        if (empty($address['zipCode'])) {
            throw new \Exception(
                __('zipCode must be set in Addressee address!', 'wc_colissimo')
            );
        }

        if (empty($address['city'])) {
            throw new \Exception(
                __('city must be set in Addressee address!', 'wc_colissimo')
            );
        }

        if (in_array($this->payload['letter']['service']['productCode'], $productCodesNeedingMobileNumber)
            && (!isset($address['mobileNumber'])
                || empty($address['mobileNumber']))) {
            throw new \Exception(
                __('The ProductCode used requires that a mobile number is set!', 'wc_colissimo')
            );
        }
    }

    public function getStoreAddress() {
        $optionsName = [
            'street'      => [
                'lpc'      => 'lpc_origin_address_line_1',
                'wc'       => 'woocommerce_store_address',
                'required' => true,
            ],
            'street2'     => [
                'lpc'      => 'lpc_origin_address_line_2',
                'wc'       => 'woocommerce_store_address_2',
                'required' => false,
            ],
            'countryCode' => [
                'lpc'      => 'lpc_origin_address_country',
                'wc'       => 'woocommerce_default_country',
                'required' => true,
            ],
            'city'        => [
                'lpc'      => 'lpc_origin_address_city',
                'wc'       => 'woocommerce_store_city',
                'required' => true,
            ],
            'zipCode'     => [
                'lpc'      => 'lpc_origin_address_zipcode',
                'wc'       => 'woocommerce_store_postcode',
                'required' => true,
            ],
        ];

        $invalidAddress = false;
        $return         = ['companyName' => LpcHelper::get_option('lpc_company_name')];

        foreach ($optionsName as $key => $optionName) {
            $option = LpcHelper::get_option($optionName['lpc']);

            if ($optionName['required'] && empty($option)) {
                $invalidAddress = true;
                break;
            }

            $return[$key] = $option;
        }

        if (!$invalidAddress) {
            return $return;
        }

        $return = ['companyName' => LpcHelper::get_option('lpc_company_name')];

        foreach ($optionsName as $key => $optionName) {
            if ('countryCode' == $key) {
                // woocommerce_default_country may be the sole country code or the format 'US:IL' (i.e. with the state / province)
                $countryWithState = explode(':', WC_Admin_Settings::get_option('woocommerce_default_country'));
                $option           = reset($countryWithState);
            } else {
                $option = WC_Admin_Settings::get_option($optionName['wc']);
            }

            $return[$key] = $option;
        }

        return $return;
    }

    protected function getOriginalParcelNumberFromInvoice(WC_Order $order) {
        return get_post_meta($order->get_id(), LpcLabelGenerationOutward::OUTWARD_PARCEL_NUMBER_META_KEY, true);
    }

    public function getLabelFormat() {
        foreach (self::LABEL_FORMATS as $oneFormat) {
            if (false !== strpos($this->payload['outputFormat']['outputPrintingType'], $oneFormat)) {
                return $oneFormat;
            }
        }

        return '';
    }

    public function getOrderNumber() {
        return $this->orderNumber;
    }

    /**
     * @param $productCode
     *
     * @return false|int
     */
    protected function getMaxInsuranceAmountByProductCode($productCode) {
        if (!in_array($productCode, self::PRODUCT_CODE_INSURANCE_AVAILABLE)) {
            return false;
        }

        return in_array($productCode, ['A2P', 'BPR']) ? self::MAX_INSURANCE_AMOUNT_RELAY : self::MAX_INSURANCE_AMOUNT;
    }
}
