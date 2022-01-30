<?php
namespace Practice\EventsObserver\Observer;

// use event observer
use Magento\Framework\Event\Observer;
// use event interface
use Magento\Framework\Event\ObserverInterface;
class OurObserver implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @rerurn void
     */
    public function execute(Observer $observer)
    {
        $message = $observer->getData('greeting');
        $message->setGreeting('Hello Magento i am akshay');
    }
}


?>