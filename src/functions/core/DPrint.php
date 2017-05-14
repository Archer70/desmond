<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VoidType;

class DPrint implements DesmondFunction
{
    public static function id()
    {
        return 'print';
    }

    public static function run(array $strings)
    {
        $string = '';
        foreach ($strings as $arg) {
            $string .= $arg->value();
        }
        print($string);
        return new VoidType();
    }
}