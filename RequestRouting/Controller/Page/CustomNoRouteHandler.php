<?php

namespace Practice\RequestRouting\Controller\Page;

class CustomNoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $request->setRouteName('request_routing')->setControllerName('page')->setActionName('customnoroute');

        return true;
    }
}


?>