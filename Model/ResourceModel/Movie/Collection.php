<?php
namespace Magenest\Study\Model\ResourceModel\Movie;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    public function _construct() {
        $this->_init('Magenest\Study\Model\Movie',
            'Magenest\Study\Model\ResourceModel\Movie');
    }
}