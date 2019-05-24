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
     *
     * @return self
     */
    private function setWidth($width)
    {
        $this->width = str_replace(',', '.', $width);
    }

    /**
     * Set the value of height.
     *
     * @return self
     */
    private function setHeight($height)
    {
        $this->height = str_replace(',', '.', $height);
    }

    /**
     * Set the value of price.
     *
     * @return self
     */
    private function setPrice($price)
    {
        $this->price = str_replace(',', '.', $price);
    }
}
