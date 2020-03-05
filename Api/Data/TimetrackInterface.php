<?php

namespace Htmlpet\CheckoutTimetrack\Api\Data;

interface TimetrackInterface
{
    public function getOrderId();

    public function getTimetrack();

    public function setOrderId($orderId);

    public function setTimetrack($timetrack);
}