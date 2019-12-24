<?php
namespace Magenest\Study\Model\Config\Source;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template;


class MovieRows extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_collectionFactory;
    public function __construct(
        Template\Context $context,
        \Magenest\Study\Model\ResourceModel\MagenestMovie\CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $countCollection = $this->_collectionFactory->create()->count();
        $element->setData('readonly', 1);
        $element->setData('value', $countCollection);
        return $element->getElementHtml();

    }
}