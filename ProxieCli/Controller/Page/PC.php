<?php
namespace Practice\ProxieCli\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Practice\ProxieCli\Model\HeavyService;

class PC extends \Magento\Framework\App\Action\Action
{
    protected $heavyservice;
    protected $http;

    public function __construct(Context $context,
    HeavyService $heavyservice,Http $http)
    {
        $this->heavyservice=$heavyservice;
        $this->http=$http;
        parent::__construct($context);
    }
    
    public function execute()
	{
        $id=$this->http->getParam('id',0);
        if($id==1)
        {
            $this->heavyservice->printHeavyServiceMessage();
        }else{
            echo "Heavy Service not used";
        }        
    }
}

?>