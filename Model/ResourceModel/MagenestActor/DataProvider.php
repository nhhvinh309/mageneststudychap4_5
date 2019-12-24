<?php
namespace Magenest\Study\Model\ResourceModel\MagenestActor;

use Magenest\Study\Model\ResourceModel\MagenestActor\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $actorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $actorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $actor) {
            $this->_loadedData[$actor->getId("actor_details")] = $actor->getData();
        }
//        $this->_loadedData[''];
        return $this->_loadedData;
    }
}