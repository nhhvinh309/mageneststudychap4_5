<?php

namespace Magenest\Study\Model\Config\Source;

class SelectDirector implements \Magento\Framework\Option\ArrayInterface
{
    protected $methodCollectionFactory;
    public function __construct(
        \Magenest\Study\Model\ResourceModel\MagenestDirector\CollectionFactory $methodCollectionFactory
    ) {
        $this->methodCollectionFactory = $methodCollectionFactory;
    }
    public function toOptionArray()
    {
        $collection = $this->methodCollectionFactory->create();
        $options = [
            [
                'value' => '',
                'label' => __('Select value')
            ]
        ];
        $options = array_merge($options, $collection->toOptionArray());
        return $options;
    }
}