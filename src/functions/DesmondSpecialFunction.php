<?php
namespace Desmond\functions;

interface DesmondSpecialFunction
{
    public static function run(array $args, $function, &$currentEnv, $eval);
}
