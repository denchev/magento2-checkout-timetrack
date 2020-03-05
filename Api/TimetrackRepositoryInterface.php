<?php

namespace Htmlpet\CheckoutTimetrack\Api;

interface TimetrackRepositoryInterface
{
    public function save(\Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface $timetrack);

    public function getById($id);

    public function getByOrderId($orderId);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    public function delete(\Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface $timetrack);

    public function deleteById($orderId);
}