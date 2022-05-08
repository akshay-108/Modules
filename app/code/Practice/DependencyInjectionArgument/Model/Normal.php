<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\SizeInterface;

class Normal implements SizeInterface
{
    public function getSize()
    {
        return "Normal";
    }
}


?>