<?php
namespace Desmond\data_types;

class NilType extends AbstractAtom
{
    public function __construct($token)
    {
        $this->setValue(null);
    }
}
