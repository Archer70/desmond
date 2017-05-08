<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\functions\core\FileContents;
use Desmond\functions\core\Ast;
use Desmond\data_types\StringType;

class EvalBlock implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $return = $eval->getReturn($args[0]);
        return $eval->getReturn($return);
    }
}
