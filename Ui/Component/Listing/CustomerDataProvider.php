<?php
class CustomerDataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('custom_table')],
            'main_table.entity_id = secondTable.customer_id',
            ['my_custom_column']
        );
        return $this;
    }
}