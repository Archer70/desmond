<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class Let implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $hash = $args[0];
        $function = $args[1];
        $newEnvId = $env->makeChild();

        $env = $env->values[$newEnvId];
        foreach ($hash->value() as $key => $val) {
            $env->set($key, $eval->getReturn($val));
        }
        $funcVal = $eval->getReturn($function);

        $env = $env->getParent();
        $env->destroyChild($newEnvId);
        return $funcVal;
    }
}
