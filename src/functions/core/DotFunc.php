<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VectorType;
use Exception;

class DotFunc implements DesmondFunction
{
    public function id()
    {
        return '.func';
    }

    public function run(array $args)
    {
        $function = self::getFunction($args);
        $args = self::getArgs($args);

        if (!empty($args)) {
            return $function(...$args);
        } else {
            return call_user_func($function);
        }
    }

    private static function getArgs($args)
    {
        array_shift($args);
        $argValues = [];
        foreach ($args as $arg) {
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
