<?php
namespace Desmond\data_types;

class VoidType extends AbstractAtom
{
    public function __toString()
    {
        return '';
    }
}
