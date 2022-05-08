<?php
namespace Practice\DependencyInjection2\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $productRepositoryInterface;
    public function __construct
    (
        Context $context,
        ProductRepositoryInterface $productRepositoryInterface
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        parent::__construct($context);
    }
    public function execute()
    {
        echo get_class($this->productRepositoryInterface);
    }
}

?>