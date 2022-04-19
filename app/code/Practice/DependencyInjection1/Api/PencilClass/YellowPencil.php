<?php
namespace Practice\DependencyInjection1\Api\PencilClass;

class YellowPencil implements \Practice\DependencyInjection1\Api\DependencyInterface\PencileInterface
{
    public function getPencilType()
    {
        return "Yellow Pencil";
    }
}


?>