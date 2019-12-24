<?php
namespace Magenest\Study\Model\ResourceModel\MagenestMovie;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    public function _construct() {
        $this->_init('Magenest\Study\Model\MagenestActor',
            'Magenest\Study\Model\ResourceModel\MagenestActor');
    }
}