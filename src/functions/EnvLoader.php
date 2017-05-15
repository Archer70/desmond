<?php
namespace Desmond\functions;
use Desmond\Environment;

class EnvLoader
{
    public static function loadInto(Environment $env, $functionDir)
    {
        foreach (FileOperations::getFunctionFiles() as $file) {
            $class = sprintf('Desmond\\functions\\%s\\%s',
                $functionDir, substr($file, 0, -4));
            $function = new $class;
            $env->set($function->id(), $function);
        }
    }
}
