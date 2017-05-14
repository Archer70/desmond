<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ListType;
use Desmond\data_types\VectorType;
use Desmond\data_types\NumberType;
use Desmond\data_types\NilType;
use Desmond\exceptions\ArgumentException;

class Nth implements DesmondFunction
{
    public static function id()
    {
        return 'nth';
    }

    public static function run(array $args)
    {
        if (!isset($args[0]) || !($args[0] instanceof ListType) && !($args[0] instanceof VectorType)) {
            throw new ArgumentException('Nth expects first argument to be a List or Vector.');
        }
        if (!isset($args[1]) || !($args[1] instanceof NumberType)) {
            throw new ArgumentException('Nth expects second argument to be a Number.');
        }
        $list = $args[0]->value();
        $index = $args[1]->value();
        if (!array_key_exists($index, $list)) {
            return new NilType();
        }
        return $list[$index];
    }
}
