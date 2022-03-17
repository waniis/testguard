<?php

require_once __DIR__ . DS . 'lpc_abstract_shipping.php';

class LpcExpert extends LpcAbstractShipping {
    const ID = 'lpc_expert';

    public function __construct($instance_id = 0) {
        $this->id                 = self::ID;
        $this->method_title       = __('Colissimo Expert', 'wc_colissimo');
        $this->method_description = __('For international delivery only', 'wc_colissimo');

        parent::__construct($instance_id);
    }

    public function isAlwaysFree() {
        return LpcHelper::get_option('lpc_expert_IsAlwaysFree', 'no');
    }

    public function freeFromOrderValue() {
        return LpcHelper::get_option('lpc_expert_FreeFromOrderValue', null);
    }
}
