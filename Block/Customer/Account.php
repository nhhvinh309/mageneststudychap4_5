<?php
namespace Magenest\Study\Block\Customer;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;

class Account extends Template
{
    protected $urlBuilder;
    protected $customerSession;
    protected $storeManager;
    protected $customerModel;
    public function __construct(Template\Context $context,
                                UrlInterface $urlBuilder,
                                SessionFactory $customerSession,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                \Magento\Customer\Model\Customer $customerModel,
                                array $data = [])
    {
        $this->urlBuilder = $urlBuilder;
        $this->customerSession = $customerSession;
        $this->customerModel = $customerModel;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
        $collection = $this->getContracts();
        $this->setCollection($collection);
    }
    public function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl();
    }
    public function getMediaUrl()
    {
        return $this->getBaseUrl() . 'pub/media/';
    }
    public function getCustomerImageUrl($filePath){
        return $this->getMediaUrl() . 'customer' . $filePath;
    }
    public function getFileUrl(){
        $customerData = $this->customerModel->load($this->customerSession->getId());
        $url = $customerData->getData('customer_image');
        if (!empty($url)) {
            return $this->getCustomerImageUrl($url);
        }
        return false;
    }

}