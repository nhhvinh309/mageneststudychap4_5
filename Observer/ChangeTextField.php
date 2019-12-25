<?php

namespace Magenest\Study\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeTextField implements ObserverInterface
{
    protected $_configInterface;
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configInterface,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_configInterface = $configInterface;
        $this->_scopeConfig = $scopeConfig;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $value = $this->_scopeConfig->getValue('study/moviepage/header_title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($value == "Ping")
            $this->_configInterface->saveConfig('study/moviepage/header_title', "Pong", 'default', 0);
    }
}