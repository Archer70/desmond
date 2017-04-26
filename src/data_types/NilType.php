<?php
namespace Desmond\data_types;

class NilType extends AbstractAtom
{
    public function __construct()
    {
        $this->setValue(null);
    }
}
