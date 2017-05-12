<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\NilType;

class Conditional implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $condition = $eval->getReturn($args[0])->value();
        if ($condition !== null && $condition !== false) {
            return $eval->getReturn($args[1]);
        } else {
            return isset($args[2]) ? $eval->getReturn($args[2]) : new NilType();
        }
    }
}
