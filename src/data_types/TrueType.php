<?php
namespace Desmond\data_types;

class TrueType extends AbstractAtom
{
    public function __construct()
    {
        $this->setValue(true);
    }
}
