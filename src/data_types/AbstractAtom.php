<?php
namespace Desmond\data_types;

abstract class AbstractAtom
{
    private $name;
    private $value;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function type()
    {
        return __CLASS__;
    }
}
