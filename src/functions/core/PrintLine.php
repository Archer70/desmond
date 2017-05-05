<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VoidType;

class PrintLine implements DesmondFunction
{
    public static function id()
    {
        return 'print-line';
    }

    public static function run(array $strings)
    {
        $string = '';
        foreach ($strings as $arg) {
            $string .= $arg->value();
        }
        print($string . "\n");
        return new VoidType();
    }
}
