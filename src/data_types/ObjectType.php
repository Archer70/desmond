<?php
namespace Desmond\data_types;

class ObjectType extends AbstractAtom
{
    public function __construct($object)
    {
        $this->setValue($object);
    }

    public function __toString()
    {
        return 'nil';
    }
}
