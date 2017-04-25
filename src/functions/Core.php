<?php
namespace Desmond\functions;
use Desmond\data_types\IntegerType;
use Desmond\data_types\StringType;
use Desmond\data_types\TrueType;

class Core
{
    private static $FUNCTION_LIST = [
        '+' => 'addition',
        '-' => 'subtraction',
        '*' => 'multiplication',
        '/' => 'division',
        'print' => 'outputPrint',
        'print-line' => 'outputPrintLine'
    ];

    public static function run($func, $args)
    {
        if (array_key_exists($func, self::$FUNCTION_LIST)) {
            return self::{self::$FUNCTION_LIST[$func]}($args);
        }
    }

    private static function addition($args)
    {
        $value = 0;
        foreach ($args as $arg) {
            $value += $arg->value();
        }
        return new IntegerType($value);
    }

    private static function subtraction($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value -= $number->value();
        }
        return new IntegerType($value);
    }

    private static function multiplication($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value *= $number->value();
        }
        return new IntegerType($value);
    }

    private static function division($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value /= $number->value();
        }
        return new IntegerType($value);
    }

    private static function outputPrint($string)
    {
        print($string[0]->value());
        return $string[0];
    }

    private static function outputPrintLine($string)
    {
        print($string[0]->value() . "\n");
        return $string[0];
    }
}
