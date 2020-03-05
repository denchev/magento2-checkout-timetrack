<?php

namespace Htmlpet\CheckoutTimetrack\Api\Data;

interface TimetrackSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface[]
     */
    public function getItems();

    /**
     * @param \Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}