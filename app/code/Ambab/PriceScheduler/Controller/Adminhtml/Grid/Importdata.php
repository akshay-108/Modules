<?php

namespace Ambab\PriceScheduler\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class Importdata extends \Magento\Backend\App\Action
{
    private $coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {                                 

       parent::__construct($context);
       $this->coreRegistry = $coreRegistry;
    }

    public function execute()
    {
        $rowData = $this->_objectManager->create('Ambab\PriceScheduler\Model\Locator');
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Import Locator Data'));
        return $resultPage;
    }

    // used for acl.xml
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ambab_PriceScheduler::add_datalocation');
    }
}