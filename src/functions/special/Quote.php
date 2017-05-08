<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class Quote implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        return $args[0];
    }
}
