<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\StringType;

class Debug implements DesmondFunction
{
    public function id()
    {
        return 'debug';
    }

    public function run(array $args)
    {
        $string = '';
        foreach ($args as $arg) {
            $string .= $arg->__toString();
        }
        return new StringType($string);
    }
}
