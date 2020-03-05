<?php

namespace Htmlpet\CheckoutTimetrack\Plugin;

use \Magento\Sales\Model\OrderRepository;
use \Magento\Sales\Api\Data\OrderInterface;
use \Htmlpet\CheckoutTimetrack\Api\TimetrackRepositoryInterface;

class AddCheckoutTimetrack
{
    private $timetrackRepository;

    public function __construct(TimetrackRepositoryInterface $timetrackRepository)
    {
        $this->timetrackRepository = $timetrackRepository;
    }

    public function afterGet(OrderRepository $subject, OrderInterface $order)
    {
        $this->addCheckoutTimetrack($order);

        return $order;
    }

    public function afterGetList(OrderRepository $subject, $orders)
    {
        foreach ($orders as $order) {
            $this->addCheckoutTimetrack($order);
        }

        return $orders;
    }

    private function addCheckoutTimetrack($order)
    {
        $extensionAttributes = $order->getExtensionAttributes();

        $timetrack = $this->timetrackRepository->getByOrderId($order->getId());
        $extensionAttributes->setCheckoutTimetocomplete($timetrack->getTimetrack());

        $order->setExtensionAttributes($extensionAttributes);

        return $order;
    }
}