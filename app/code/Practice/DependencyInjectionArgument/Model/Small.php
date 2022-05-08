<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\SizeInterface;

class Small implements SizeInterface
{
    public function getSize()
    {
        return "Small";
    }
}


?>