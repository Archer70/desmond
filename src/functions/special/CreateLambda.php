<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\LambdaType;

class CreateLambda implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        return new LambdaType($eval, $args[0], $args[1]);
    }
}
