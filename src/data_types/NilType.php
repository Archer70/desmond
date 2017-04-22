<?php
namespace Desmond\data_types;

class NilType extends Type
{
    public function __construct($token)
    {
        $this->setValue(null);
    }
}
