<?php
namespace Desmond\data_types;

class TrueType extends Type
{
    public function __construct($token)
    {
        $this->setValue(true);
    }
}
