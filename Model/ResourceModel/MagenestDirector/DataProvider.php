<?php
namespace Magenest\Study\Model\ResourceModel\MagenestDirector;

use Magenest\Study\Model\ResourceModel\MagenestDirector\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $directorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $directorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $director) {
            $this->_loadedData[$director->getId("director_details")] = $director->getData();
        }
//        $this->_loadedData[''];
        return $this->_loadedData;
    }
}