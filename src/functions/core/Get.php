<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\AbstractCollection;
use Desmond\data_types\NumberType;
use Desmond\data_types\StringType;
use Desmond\data_types\SymbolType;
use Desmond\exceptions\ArgumentException;

class Get implements DesmondFunction
{
    public function id()
    {
        return 'get';
    }

    public function run(array $args)
    {
        if (!isset($args[0]) || !($args[0] instanceof AbstractCollection)) {
            throw new ArgumentException('Get expects first argument to be a collection.');
        }
        if (!isset($args[1])
            || (!($args[1] instanceof NumberType)
            && !($args[1] instanceof StringType)
            && !($args[1] instanceof SymbolType)))
        {
            throw new ArgumentException('Get expects second argument to be a Number, Symbol or String.');
        }
        return $args[0]->get($args[1]->value());
    }
}
