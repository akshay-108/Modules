<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\SizeInterface;

class Big implements SizeInterface
{
    public function getSize()
    {
        return "Big";
    }
}


?>