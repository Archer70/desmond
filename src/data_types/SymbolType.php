<?php
namespace Desmond\data_types;
use Desmond\data_types\Type;

class SymbolType extends AbstractAtom
{
    public function __construct($token)
    {
        $this->setValue($token);
    }
}
