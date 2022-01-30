<?php
namespace Practice\EventsObserver\Controller\Page;

// magento event manager
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\App\Action\Context;
class EO extends \Magento\Framework\App\Action\Action
{

    // data members
    protected $_eventManager;
    // dependency injection in constructor argument
    public function __construct(Context $context,
    ManagerInterface $_eventManager)
    {
        $this->_eventManager=$_eventManager;
        parent::__construct($context);
    }
    public function execute()
    {
       $message= new \Magento\Framework\DataObject(array('greeting'=>'Hello Magento'));
        // custom event manager
       $this->_eventManager->dispatch('custom_event',['greeting'=>$message]);
       echo $message->getGreeting();
    }
}


?>