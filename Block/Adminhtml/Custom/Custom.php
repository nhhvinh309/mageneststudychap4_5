<?php

namespace Magenest\Study\Block\Adminhtml\Custom;

use Magento\Framework\View\Element\Template;

class Custom extends \Magento\Framework\View\Element\Template {

    protected $fullModuleList;
    protected $objectManager;
    public function __construct(Template\Context $context,\Magento\Framework\Module\FullModuleList $fullModuleList
    )
    {
        $this->fullModuleList = $fullModuleList;
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        parent::__construct($context);
    }

    public function getModulesNumber()
    {
        $allModules = $this->fullModuleList->getNames();
        $listOfModules = [0 => 0, 1 => 0];
        foreach ($allModules as $module)
        {
            if(strpos($module, 'Magento') !== false)
                $listOfModules[0] += 1;
            else
                $listOfModules[1] += 1;
        }
        return $listOfModules;
    }

    public function getCustomerNumber()
    {
        $customerObj = $this->objectManager->create('Magento\Customer\Model\Customer')->getCollection();
        return $customerObj->getSize();
    }
    public function getProductNumber()
    {
        $productObj = $this->objectManager->create('Magento\Catalog\Model\Product')->getCollection();
        return $productObj->getSize();
    }
    public function getOrderNumber()
    {
        $orderObj = $this->objectManager->create('Magento\Sales\Model\Order')->getCollection();
        return $orderObj->getSize();
    }
    public function getInvoiceNumber()
    {
        $invoiceObj = $this->objectManager->create('Magento\Sales\Model\Order\Invoice')->getCollection();
        return $invoiceObj->getSize();
    }
    public function getCreditMemoNumber()
    {
        $creditMemoObj = $this->objectManager->create('Magento\Sales\Model\Order\Creditmemo')->getCollection();
        return $creditMemoObj->getSize();
    }

}
