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
                $this->{$property} = $value;
            }
        }
    }

    /**
     * Set property value or fail.
     *
     * @throws Exception
     *
     * @param string $property
     * @param mixed  $value
     */
    public function __set(string $property, $value)
    {
        $method = 'set'.str_replace('_', '', ucwords($property, '_'));

        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } elseif (property_exists($this, $property)) {
            $this->{$property} = $value;
        } else {
            throw new \Exception("Property {$property} does not exist!");
        }
    }

    /**
     * Return the correct property value or fail.
     *
     * @throws Exception
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get(string $property)
    {
        $method = 'get'.str_replace('_', '', ucwords($property, '_'));

        if (method_exists($this, $method)) {
            return $this->{$method}();
        } elseif (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \Exception("Property {$property} does not exist!");
    }

    /**
     * Return an associative array from object instance.
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this;
    }
}

