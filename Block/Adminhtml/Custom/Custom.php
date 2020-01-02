<?php

namespace Magenest\Study\Block\Adminhtml\Custom;

use Magento\Framework\View\Element\Template;

class Custom extends \Magento\Framework\View\Element\Template {

    protected $fullModuleList;
    public function __construct(Template\Context $context,
                                \Magento\Framework\Module\FullModuleList $fullModuleList,
                                array $data = [])
    {
        $this->fullModuleList = $fullModuleList;
        parent::__construct($context, $data);
    }

    public function getMagentoModules()
    {
        $allModules = $this->fullModuleList->getNames();
        $countMagentoModules = 0;
        foreach ($allModules as $module)
        {
            if(strpos($module, 'Magento') !== false)
                $countMagentoModules += 1;
        }
        return $countMagentoModules;
    }
    public function getVendorModules()
    {
        $allModules = $this->fullModuleList->getNames();
        $count = 0;
        foreach ($allModules as $module)
        {
            if(strpos($module, 'Magento') !== true)
                $count += 1;
        }
        return $count;
    }
    public function getNumber(){

        return 777;
    }
}
