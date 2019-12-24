<?php
namespace Magenest\Study\Block\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\ObjectManagerInterface;

class Button extends \Magento\Config\Block\System\Config\Form\Field {

    const CHECK_TEMPLATE = 'system/config/button.phtml';

    public function __construct(Context $context,
                                $data = array())
    {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate(static::CHECK_TEMPLATE);
        }
        return $this;
    }
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $this->addData(
            [
                'url' => "admin/system_config/edit/section/study/",
                'html_id' => $element->getHtmlId(),
            ]
        );

        return $this->_toHtml();
    }

}