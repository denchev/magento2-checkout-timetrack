<?php

namespace Htmlpet\CheckoutTimetrack\Model\ResourceModel;

use Htmlpet\CheckoutTimetrack\Api\TimetrackRepositoryInterface;
use Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterface;
use Htmlpet\CheckoutTimetrack\Api\Data\TimetrackInterfaceFactory;
use Htmlpet\CheckoutTimetrack\Model\ResourceModel\Timetrack as ResourceModel;
use Htmlpet\CheckoutTimetrack\Api\Data\TimetrackSearchResultsInterfaceFactory as SearchResultsFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;

class TimetrackRepository implements TimetrackRepositoryInterface
{
    private $timetrackFactory;

    private $resource;

    public function __construct(
        ResourceModel $resource,
        TimetrackInterfaceFactory $timetrackFactory,
        SearchResultsFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor = null
    )
    {
        $this->resource = $resource;
        $this->timetrackFactory = $timetrackFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor ?: ObjectManager::getInstance()
        ->get(\Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface::class);
    }

    public function save(TimetrackInterface $timetrack) 
    {
        try {
            $result = $timetrack->save();
        } catch(\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @return TimetrackInterface
     */
    public function getById($id) {
        $timetrack = $this->timetrackFactory->create();
        $this->resource->load($timetrack, $id);
        return $timetrack;
    }

    public function getByOrderId($orderId)
    {
        $timetrack = $this->timetrackFactory->create();
        $this->resource->load($timetrack, $orderId, 'order_id');
        return $timetrack;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria) 
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        
        $this->collectionProcessor->process($searchCriteria, $searchResults);
        
        return $searchResults;
    }

    public function delete(TimetrackInterface $timetrack) 
    {
        $this->resource->delete($timetrack->getId());
    }

    public function deleteById($id) 
    {
        $this->resource->delete($id);    
    }
}