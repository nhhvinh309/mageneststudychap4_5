<?php

namespace Magenest\Study\Block;

use Magento\Framework\View\Element\Template;

class TestModel extends \Magento\Framework\View\Element\Template {


    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

}
