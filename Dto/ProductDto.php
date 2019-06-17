<?php

namespace App\Dto;

final class ProductDto extends AbstractDto
{
    private $color = 'black';
    private $width = 0;
    private $height = 0;
    private $price = 0;

    /**
     * Set the value of width.
     */
    private function setWidth($width)
    {
        $this->width = str_replace(',', '.', $width);
    }

    /**
     * Set the value of height.
     */
    private function setHeight($height)
    {
        $this->height = str_replace(',', '.', $height);
    }

    /**
     * Set the value of price.
     */
    private function setPrice($price)
    {
        $this->price = str_replace(',', '.', $price);
    }

    /**
     * Get the value of color.
     *
     * @return string
     */
    private function getColor()
    {
        return str_replace('black', '#000000', $this->color);
    }

}
