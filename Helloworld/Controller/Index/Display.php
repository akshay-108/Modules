<?php

namespace Practice\Helloworld\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $_pagefactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $_pagefactory)
    {
        $this->_pagefactory = $_pagefactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pagefactory->create();
    }
}


?>