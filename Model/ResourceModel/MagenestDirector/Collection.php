<?php
namespace Magenest\Study\Model\ResourceModel\MagenestDirector;

class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    public function _construct() {
        $this->_init('Magenest\Study\Model\MagenestDirector',
            'Magenest\Study\Model\ResourceModel\MagenestDirector');
    }
}