<?php
namespace Desmond\data_types;

class FalseType extends AbstractAtom
{
    public function __construct()
    {
        $this->setValue(false);
    }

    public function __toString()
    {
        return 'false';
    }
}
