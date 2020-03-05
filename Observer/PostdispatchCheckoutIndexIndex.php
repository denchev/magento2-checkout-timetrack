<?php

namespace Htmlpet\CheckoutTimetrack\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PostdispatchCheckoutIndexIndex implements ObserverInterface
{
    private $_customerSession;

    public function __construct(\Magento\Customer\Model\Session $customerSession)
    {
        $this->_customerSession = $customerSession;
    }

    public function execute(Observer $observer)
    {
        $this->_customerSession->setCheckoutStartAt(time());
    }
}