<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VoidType;

class DebugDump extends DesmondFunction
{
    public function id()
    {
        return 'debug-dump';
    }

    public function run(array $args)
    {
        foreach ($args as $arg) {
            echo $arg;
        }
        return new VoidType();
    }
}
