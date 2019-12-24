<?php
namespace Magenest\Study\Model;
class MagenestMovie extends
    \Magento\Framework\Model\AbstractModel {

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource
        $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb
        $resourceCollection = null,
        array $data = []
    ) { parent::__construct($context, $registry, $resource,
        $resourceCollection, $data);
    }
    public function _construct() {
        $this->_init('Magenest\Study\Model\ResourceModel\MagenestMovie');
    }
    public function getNumberofRows(){
        $number = 777;
        return number;
    }
}