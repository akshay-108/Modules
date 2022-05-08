<?php

namespace Practice\DependencyInjection1\Controller\Index;

use Magento\Framework\App\Action\Context;
use Practice\DependencyInjection1\Api\DependencyInterface\PencileInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $pencileInterface;

    public function __construct(
        Context $context, 
        PencileInterface $pencileInterface
    )
    {
        $this->pencileInterface = $pencileInterface;
        parent::__construct($context);
    }
    public function execute()
    {
        echo $this->pencileInterface->getPencilType();
    }
}

?>