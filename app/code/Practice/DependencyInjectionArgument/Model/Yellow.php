<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\ColorInterface;

class Yellow implements ColorInterface
{
    public function getColor()
    {
        return "Yellow";
    }
}

?>