<?php
namespace Ambab\PriceScheduler\Controller\Adminhtml\Grid;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Ambab\PriceScheduler\Model\GridFactory
     */
    var $gridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Ambab\PriceScheduler\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ambab\PriceScheduler\Model\GridFactory $gridFactory,
        \Magento\Framework\Filesystem\Driver\File $file,
        \Magento\Framework\File\Csv $csv,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $_uploaderFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->file = $file;
        $this->csv = $csv;
        $this->_uploaderFactory = $_uploaderFactory;
        $this->_varDirectory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->gridFactory = $gridFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $files = $this->getRequest()->getFiles()->toArray();
        $csvInfoFile = $files['product_data'];
        $uploader = $this->_uploaderFactory->create(['fileId' => $csvInfoFile]);
        $workingDir = $this->_varDirectory->getAbsolutePath('importexport/');
        $result = $uploader->save($workingDir);
        $path = $result['path'] . $result['file'];
        $json = $this->csv->getData($path);

        if (!$data && $uploader->getFileExtension($path) == 'csv') {
            $this->_redirect('grid/grid/addrow');
            return;
        }
        if($uploader->getFileExtension($path) == 'csv')
        {
            try {
                $rowData = $this->gridFactory->create();
                $data['product_data'] = json_encode($json);
                $rowData->setData($data);
                if (isset($data['id'])) {
                    $rowData->setEntityId($data['id']);
                }
                $rowData->save();
                $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
            }
            $this->_redirect('grid/grid/index');
        }else{
            $this->messageManager->addError(__("check your file extension, only <strong>.csv</strong> extension is allowed"));
            $this->_redirect('grid/grid/addrow');
            return;
        }
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ambab_PriceScheduler::save');
    }
}