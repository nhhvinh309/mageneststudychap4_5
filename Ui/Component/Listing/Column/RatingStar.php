<?php

namespace Magenest\Study\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class RatingStar extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                    $pixels = $items['rating'] * 10;
                    $items['rating_star'] = '<div style="float: left; position: relative; width: 80px">
                                                <div><img style="max-width: 100px;" src="https://image.ibb.co/jpMUXa/stars_blank.png"></div>
                                                <div style="position: absolute; top: 0; left: 0; overflow: hidden; width: ' . $pixels . 'px">
                                                    <img style="max-width: 100px;" src="https://image.ibb.co/caxgdF/stars_full.png" alt="">
                                                </div>
                                             </div>';
            }
        }
        return $dataSource;
    }
}