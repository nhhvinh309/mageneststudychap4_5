<?php

namespace Magenest\Study\Block\Account\Dashboard;

class Info extends \Magento\Framework\View\Element\Template
{
    protected $viewFileUrl;
    protected $customerSession;
    protected $customer;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\Customer $customer,
        \Magento\Framework\View\Asset\Repository $viewFileUrl,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customer = $customer;
        $this->customerSession = $customerSession;
        $this->viewFileUrl = $viewFileUrl;
    }
    public function getCustomerDetails(){
        $customer_id = $this->customerSession->getCustomer()->getId();
        $customerDetail = $this->customer->load($customer_id);
        return $customerDetail;
    }

    public function getCustomerAvatar()
    {
        $customer_id = $this->customerSession->getCustomer()->getId();
        if ($customer_id) {
            $customerDetail = $this->customer->load($customer_id);
            if ($customerDetail && !empty($customerDetail->getProfilePicture())) {
                return "http://127.0.0.1/magento233/index.php/admin/customer/index/viewfile/image/" . base64_encode($customerDetail->getProfilePicture());
            }
        }
      return $this->viewFileUrl->getUrl('Magenest_Study::images/no-profile-photo.jpg');
    }
}
