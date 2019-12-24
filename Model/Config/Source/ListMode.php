<?php

namespace Magenest\Study\Model\Config\Source;

class ListMode implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Show')],
            ['value' => '2', 'label' => __('Not show')]
        ];
    }
}