<?php
namespace Practice\DependencyInjectionArgument\Controller\Index;

use Magento\Framework\App\Action\Context;
use Practice\DependencyInjectionArgument\Api\DependencyInterface\PencileInterface;

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

        // use object manager
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $pencil = $objectManager->create('Practice\DependencyInjectionArgument\Model\Pencil');
        var_dump($pencil);

        echo "\n";

        $objectManager2 = \Magento\Framework\App\ObjectManager::getInstance();
        $book = $objectManager2->create('Practice\DependencyInjectionArgument\Model\Book');
        var_dump($book);
    }
}

?>