<?php

namespace App\Dto;

abstract class AbstractDto
{
    /**
     * Insert all properties from a data array ​​at the same time.
     * Non-existent properties are ignored.
     *
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if (null !== $data) {
            foreach ($data as $property => $value) {
                $method = 'set'.str_replace('_', '', ucwords($property, '_'));

                if (method_exists($this, $method)) {
                    $this->{$method}($value);
                } elseif (property_exists($this, $property)) {
                    $this->{$property} = $value;
                }
            }
        }
    }

    /**
     * Return the correct property or fail.
     *
     * @throws Exception
     *
     * @param string $property
     */
    public function __get(string $property)
    {
        if (!property_exists($this, $property)) {
            throw new \Exception("Property {$property} does not exists");
        }

        return $this->{$property};
    }
}
