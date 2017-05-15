<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class EnvironmentFunction implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        foreach ($args as $formIndex => $atom) {
            $args[$formIndex] = $eval->getReturn($atom);
        }
        $actualFunction = $env->get($function);
        $object = new $actualFunction;
        return $object->run($args);
    }
}
