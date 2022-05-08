<?php
namespace Practice\DependencyInjection1\Api\PencilClass;

class RedPencil implements \Practice\DependencyInjection1\Api\DependencyInterface\PencileInterface
{
    public function getPencilType()
    {
        return "Red Pencil";
    }
}

?>