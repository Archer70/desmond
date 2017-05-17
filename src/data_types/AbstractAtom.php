<?php
namespace Desmond\data_types;

abstract class AbstractAtom
{
    private $value = null;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }
}
