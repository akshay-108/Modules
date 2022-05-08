<?php

namespace Practice\DependencyInjectionArgument\Model;

use Practice\DependencyInjectionArgument\Api\DependencyInterface\ColorInterface;
use Practice\DependencyInjectionArgument\Api\DependencyInterface\SizeInterface;

class Book
{
    protected $color;
    protected $size;

    public function __contruct(ColorInterface $color,SizeInterface $size)
    {
        $this->color = $color;
        $this->size = $size;
    }
}


?>