<?php
namespace Mageplaza\AdminConfiguration2\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $helperData;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Mageplaza\AdminConfiguration2\Helper\Data $helperData
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->helperData = $helperData;
		return parent::__construct($context);
	}

	public function execute()
	{
		echo $this->helperData->getGeneralConfig('enable');
		echo $this->helperData->getGeneralConfig('display_text');
		exit();
	}
}
?>
