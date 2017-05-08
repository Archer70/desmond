<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\LambdaType;

class RunLambda implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        foreach ($args as $index => $arg) {
            $args[$index] = $eval->getReturn($arg);
        }
        return $function->run($args);
    }
}
