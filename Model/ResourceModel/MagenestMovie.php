<?php
namespace Magenest\Study\Model\ResourceModel;
class MagenestMovie extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init('magenest_movie','movie_id');
    }
}