<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VectorType;
use Exception;

class DotFunc implements DesmondFunction
{
    public static function id()
    {
        return '.func';
    }

    public static function run(array $args)
    {
        $function = self::getFunction($args);
        $args = self::getArgs($args);

        if (!empty($args)) {
            return call_user_func_array($function, $args);
        } else {
            return call_user_func($function);
        }
    }

    private static function getArgs($args)
    {
        if (!isset($args[1]) || !($args[1] instanceof VectorType)) {
            return [];
        }
        $argValues = [];
        foreach ($args[1]->value() as $arg) {
            $argValues[] = $arg->value();
        }
        return $argValues;
    }

    private static function getFunction(array $args)
    {
        if (!isset($args[0])) {
            throw new Exception('.func called with no function argument. (.func <func> [args..])');
        } else if (!function_exists($args[0]->value())) {
            throw new Exception("Function \"{$args[0]->value()}\" not found.");
        } else {
            return $args[0]->value();
        }
    }
}
