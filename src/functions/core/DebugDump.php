<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VoidType;

class DebugDump implements DesmondFunction
{
    public static function id()
    {
        return 'debug-dump';
    }

    public static function run(array $args)
    {
        foreach ($args as $arg) {
            echo $arg;
        }
        return new VoidType();
    }
}
