<?php
namespace Magenest\Study\Model\ResourceModel\MagenestMovie;

use Magenest\Study\Model\ResourceModel\MagenestMovie\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $movieCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $movieCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $movie) {
            $this->_loadedData[$movie->getId("movie_details")] = $movie->getData();
        }
//        $this->_loadedData[''];
        return $this->_loadedData;
    }
}