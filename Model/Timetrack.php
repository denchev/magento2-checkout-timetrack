<?php

namespace Htmlpet\CheckoutTimetrack\Model;

use Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface;
use Magento\Framework\Model\AbstractModel;

class Timetrack extends AbstractModel implements TimetrackInterface
{

    protected function _construct()
    {
        $this->_init(\Htmlpet\CheckoutTimetrack\Model\ResourceModel\Timetrack::class);
    }

    public function getOrderId() {
        return $this->getData('order_id');
    }

    public function getTimetrack() {
        return $this->getData('timetrack');
    }

    public function setOrderId($orderId) {
        $this->setData('order_id', $orderId);
    }

    public function setTimetrack($timetrack)
    {
        $this->setData('timetrack', $timetrack);
    }
}