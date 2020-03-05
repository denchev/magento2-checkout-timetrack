<?php

namespace Htmlpet\CheckoutTimetrack\Model\ResourceModel\Timetrack;

use \Htmlpet\CheckoutTimetrack\Api\Data\TimetrackSearchResultsInterface;
use \Magento\Framework\Model\ResourceModel\Db\VersionControl\Collection as AbstractCollection;

class Collection extends AbstractCollection implements TimetrackSearchResultsInterface
{
    protected $_idFieldName = 'order_id';

    protected $_eventPrefix = 'htmlpet_checkout_timetrack_collection';

    protected $_eventObject = 'timetrack_collection';

    protected $searchCriteria;

    protected function _construct()
    {
        $this->_init(\Htmlpet\CheckoutTimetrack\Model\Timetrack::class, \Htmlpet\CheckoutTimetrack\Model\ResourceModel\Timetrack::class);
    }

    public function setItems($items) 
    {
        return $this;
    }

    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
}