<?php

namespace Magenest\Study\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeCustomerFirstName implements ObserverInterface
{
    const CUSTOMER_FIRST_NAME = "Magenest";

    protected $_customerRepositoryInterface;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customer->setFirstName(self::CUSTOMER_FIRST_NAME);
        $this->_customerRepositoryInterface->save($customer);;
    }
}