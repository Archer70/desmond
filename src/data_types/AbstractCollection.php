<?php
namespace Desmond\data_types;

abstract class AbstractCollection
{
    protected $collection = [];

    public function get($key)
    {
        return array_key_exists($key, $this->collection)
            ? $this->collection[$key] : null;
    }

    public function set($value, $key=null)
    {
        if (null !== $key) {
            $this->collection[$key] = $value;
        } else {
            $this->collection[] = $value;
        }
    }

    public function first()
    {
        return $this->get(0);
    }

    public function rest()
    {
        $copy = $this->collection;
        array_shift($copy);
        return $copy;
    }

    public function count()
    {
        return count($this->collection);
    }

    public function value()
    {
        return $this->collection; // IDK. This will probably be gone soon.
    }

    public function dump()
    {
        foreach ($this->collection as $item) {
            print_r($item);
        }
    }
}
