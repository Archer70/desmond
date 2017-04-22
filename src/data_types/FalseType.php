<?php
namespace Desmond\data_types;

class FalseType extends Type
{
    public function __construct($token)
    {
        $this->setValue(false);
    }
}
