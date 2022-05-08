<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\ColorInterface;

class Red implements ColorInterface
{
    public function getColor()
    {
        return "Red";
    }
}


?>