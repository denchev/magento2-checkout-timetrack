<?php

namespace Htmlpet\CheckoutTimetrack\Model\ResourceModel;

class Timetrack extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('htmlpet_checkout_timetrack', 'id');
    }
}