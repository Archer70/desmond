<?php
namespace Desmond\data_types;

class IntegerType extends Type
{
    public function __construct($token)
    {
        $this->setValue((int) $token);
    }
}
