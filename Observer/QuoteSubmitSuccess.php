<?php

namespace Htmlpet\CheckoutTimetrack\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class QuoteSubmitSuccess implements ObserverInterface
{
    private $_customerSession;

    private $timetrackFactory;

    private $timetrackRepository;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterfaceFactory $timetrackFactory,
        \Htmlpet\CheckoutTimetrack\Api\TimetrackRepositoryInterface $timetrackRepository
    )
    {
        $this->_customerSession = $customerSession;
        $this->timetrackFactory = $timetrackFactory;
        $this->timetrackRepository = $timetrackRepository;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getData('order');

        $checkoutStartedAt = $this->_customerSession->getCheckoutStartAt();

        $timetrack = $this->timetrackFactory->create();
        $timetrack->setOrderId($order->getId());
        $timetrack->setTimetrack($checkoutStartedAt);

        $this->timetrackRepository->save($timetrack);
    }
}