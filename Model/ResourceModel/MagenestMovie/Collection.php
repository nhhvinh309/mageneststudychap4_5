<?php
namespace Magenest\Study\Model\ResourceModel\MagenestMovie;

//class Collection extends
//    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
//
//    public function _construct() {
//        $this->_init('Magenest\Study\Model\MagenestMovie',
//            'Magenest\Study\Model\ResourceModel\MagenestMovie');
//    }
////    protected function _initSelect()
////    {
////        parent::_initSelect();
////
////        $this->getSelect()->joinLeft(
////            ['secondTable' => $this->getTable('magenest_director')],
////            'main_table.director_id = secondTable.director_id',
////            ['name'=>'director_name']
////        );
////        return $this;
////    }
//}

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'movie_id';

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        $this->_init('Magenest\Study\Model\MagenestMovie',
            'Magenest\Study\Model\ResourceModel\MagenestMovie');
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('magenest_director')],
            'main_table.director_id = secondTable.director_id',
            'secondTable.name as director_name'
        );
    }
}