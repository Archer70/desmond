<?php
namespace Desmond\data_types;

abstract class AbstractAtom
{
    private $value;

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
