<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class DefineSymbol implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$currentEnv, $eval)
    {
        $value = $eval->getReturn($args[1]);
        $currentEnv->set($args[0]->value(), $value);
        return $value;
    }
}
