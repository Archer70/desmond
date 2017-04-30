<?php
namespace Desmond\data_types;

class IntegerType extends AbstractAtom
{
    public function __construct($token)
    {
        $this->setValue((int) $token);
    }
}
