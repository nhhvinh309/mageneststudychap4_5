<?php

namespace Magenest\Study\Setup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    protected $customerSetupFactory;

    private $attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        $customerSetup->addAttribute(Customer::ENTITY, 'profile_picture', [
            'type' => 'varchar',
            'label' => 'Profile Picture',
            'input' => 'image',
            'backend' => 'Magenest\Study\Model\Attribute\Backend\Avatar',
            'required' => false,
            'visible' => true,
            'user_defined' => true,
            'sort_order' => 200,
            'position' => 200,
            'system' => 0,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_html_allowed_on_front' => true,
            'visible_on_front' => true
        ]);
        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'profile_picture')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit', 'customer_account_create'],
            ]);
        $attribute->save();
    }
}