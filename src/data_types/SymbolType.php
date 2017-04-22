<?php
namespace Desmond\data_types;
use Desmond\data_types\Type;

class SymbolType extends Type
{
    public function __construct($token)
    {
        $this->setName($token);
    }
}
