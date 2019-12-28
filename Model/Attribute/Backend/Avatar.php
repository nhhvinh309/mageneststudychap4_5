<?php

namespace Magenest\Study\Model\Attribute\Backend;
use Magenest\Study\Model\Source\Validation\Image;
class Avatar extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    public function beforeSave($object)
    {
        $validation = new Image();
        $attrCode = $this->getAttribute()->getAttributeCode();
        if ($attrCode == 'profile_picture') {
            if ($validation->isImageValid('tmpp_name', $attrCode) === false) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The profile picture is not a valid image.')
                );
            }
        }
        return parent::beforeSave($object);
    }
}