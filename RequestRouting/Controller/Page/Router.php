<?php
namespace Practice\RequestRouting\Controller\Page;

use \Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\ActionInterface;
use \Magento\Framework\App\ActionFactory;

class Router implements \Magento\Framework\App\RouterInterface
{
    protected $actionfactory;

    public function __construct(ActionFactory $actionfactory)
    {
        $this->actionfactory=$actionfactory;
    }
    public function match(RequestInterface $request)
    {
        //  customer-ac count-login
        $path=trim($request->getPathInfo(),'/');    
        $paths=explode('-',$path);
        $request->setModuleName($paths[0]);
        $request->setControllerName($paths[1]);
        $request->setActionName($paths[2]);

        return $this->actionfactory->create('Magento\Framework\App\Forward',['request'=>$request]);
    }
}


?>