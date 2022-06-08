<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\ColorInterface;

class Green implements ColorInterface
{
    public function getColor()
    {
        return "Green";
    }
}


?>