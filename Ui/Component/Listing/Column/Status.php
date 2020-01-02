<?php
namespace Magenest\Study\Ui\Component\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;

class Status extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, OrderRepositoryInterface $orderRepository, SearchCriteriaBuilder $criteria, array $components = [], array $data = [])
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                //increment_id
                $order  = $this->_orderRepository->get($item["entity_id"]);
                $status = $order->getData("increment_id");
                $status = substr($status,  0, 9);
                $status = intval($status);
                $value = "";
                $class = "";
                switch ($status % 2) {
                    case 0:
                        $value = "Even";
                        $class = 'notice';
                        break;
                    case 1;
                        $value = "Odd";
                        $class = 'critical';
                        break;
                }
                $item[$this->getData('name')] = '<span class="grid-severity-' . $class . '">' . $value . '</span>';
            }
        }
        return $dataSource;
    }
}