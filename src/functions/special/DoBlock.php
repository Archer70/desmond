<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class DoBlock implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $last = end($args);
        array_pop($args);
        foreach($args as $arg) {
            $eval->getReturn($arg);
        }
        return $eval->getReturn($last);
    }
}
