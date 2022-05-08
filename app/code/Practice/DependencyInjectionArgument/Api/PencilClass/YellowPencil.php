<?php
namespace Practice\DependencyInjectionArgument\Api\PencilClass;

class YellowPencil implements \Practice\DependencyInjectionArgument\Api\DependencyInterface\PencileInterface
{
    public function getPencilType()
    {
        return "Yellow Pencil";
    }
}


?>