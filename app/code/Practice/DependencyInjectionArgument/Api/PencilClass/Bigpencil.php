<?php

namespace Practice\DependencyInjectionArgument\Api\PencilClass;

class Bigpencil implements \Practice\DependencyInjectionArgument\Api\DependencyInterface\PencileInterface
{
    public function getPencilType()
    {
        return "Big Pencil";
    }
}

?>