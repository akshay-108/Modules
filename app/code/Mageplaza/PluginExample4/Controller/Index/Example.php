<?php

namespace Mageplaza\PluginExample4\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{
    protected $title;

	public function execute()
	{
		echo $this->setTitle('Welcome');
		echo $this->getTitle();
	}

	public function setTitle($title)
	{
		echo "Hello 2"."\n";
		return $this->title = $title;
	}

	public function getTitle()
	{
		echo "Hello 4"."\n";
		return $this->title;
	}
}

?>