<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\ColorInterface;
use Practice\DependencyInjectionArgument\Api\DependencyInterface\SizeInterface;

class Pencil implements \Practice\DependencyInjectionArgument\Api\DependencyInterface\PencileInterface
{
    protected $color;
    protected $size;

    public function __construct(ColorInterface $color, SizeInterface $size)
    {
        $this->color= $color;
        $this->size= $size;
    }

    function getPencilType()
    {
        return "Pencil has".$this->color->getColor()." color and ".$this->size->getSize()." size";
    }
}

?>