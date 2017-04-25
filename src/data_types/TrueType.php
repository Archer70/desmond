<?php
namespace Desmond\data_types;

class TrueType extends AbstractAtom
{
    public function __construct($token)
    {
        $this->setValue(true);
    }
}
