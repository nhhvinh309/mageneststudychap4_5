<?php

namespace Magenest\Study\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
class Avatar extends \Magento\Ui\Component\Listing\Columns\Column
{

    protected $viewFileUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->viewFileUrl = $viewFileUrl;
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $customer = new \Magento\Framework\DataObject($item);
                $picture_url = !empty($customer["profile_picture"]) ? $this->urlBuilder->getUrl(
                    'customer/index/viewfile/image/'.base64_encode($customer["profile_picture"])) : $this->viewFileUrl->getUrl('Magenest_Study::images/no-profile-photo.jpg');
                $item[$fieldName . '_src'] = $picture_url;
                $item[$fieldName . '_orig_src'] = $picture_url;
                $item[$fieldName . '_alt'] = 'The profile picture';
            }
        }
        return $dataSource;
    }
}