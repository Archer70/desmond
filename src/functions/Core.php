<?php
namespace Desmond\functions;
use Desmond\data_types\IntegerType;
use Desmond\data_types\StringType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;
use Desmond\data_types\VoidType;
use Desmond\data_types\VectorType;
use Desmond\Environment;
use Desmond\Lexer;

class Core
{
    private static $FUNCTION_LIST = [
        'ast' => 'ast',
        '+' => 'addition',
        '-' => 'subtraction',
        '*' => 'multiplication',
        '/' => 'division',
        '=' => 'equal',
        'equal?' => 'equal',
        'print' => 'outputPrint',
        'print-line' => 'outputPrintLine'
    ];

    public static function loadInto(Environment $env)
    {
        foreach (self::$FUNCTION_LIST as $func => $name) {
            $env->set($func, "Desmond\\functions\\Core::$name");
        }
    }

    public static function ast($args)
    {
        $string = $args[0];
        $lexer = new Lexer();
        return $lexer->readString($string->value());
    }

    public static function addition($args)
    {
        $value = 0;
        foreach ($args as $arg) {
            $value += $arg->value();
        }
        return new IntegerType($value);
    }

    public static function subtraction($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value -= $number->value();
        }
        return new IntegerType($value);
    }

    public static function multiplication($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value *= $number->value();
        }
        return new IntegerType($value);
    }

    public static function division($args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value /= $number->value();
        }
        return new IntegerType($value);
    }

    public static function equal($args)
    {
        $last = $args[0];
        array_shift($args);
        $equal = false;
        foreach ($args as $arg) {
            if ($arg->value() !== $last->value()) {
                return new FalseType();
            }
            $last = $arg;
        }
        return new TrueType();
    }

    public static function outputPrint($strings)
    {
        $string = '';
        foreach ($strings as $arg) {
            $string .= $arg->value();
        }
        print($string);
        return new VoidType();
    }

    public static function outputPrintLine($strings)
    {
        $string = '';
        foreach ($strings as $arg) {
            $string .= $arg->value();
        }
        print($string . "\n");
        return new VoidType();
    }
}
