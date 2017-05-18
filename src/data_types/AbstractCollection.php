<?php
namespace Desmond\data_types;

abstract class AbstractCollection
{
    protected $collection = [];

    abstract protected function ends();

    public function __construct(array $elements=[])
    {
        $this->collection = $elements;
    }

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
        return array_values($this->collection)[0];
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
        return $this->collection;
    }

    public function __toString()
    {
        $string = '';
        $first = true;
        foreach ($this->collection as $key => $val) {
            $separator = $first ? '' : ', ';
            $first = false;
            $string .=
                $separator.
                (is_string($key) ? $key. ' ' : '').
                (method_exists($val, '__toString') ? $val->__toString() : $val);
        }
        return $this->ends()[0] . $string . $this->ends()[1];
    }
}
