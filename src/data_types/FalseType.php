<?php
namespace Desmond\data_types;

class FalseType extends AbstractAtom
{
    public function __construct($token)
    {
        $this->setValue(false);
    }
}
