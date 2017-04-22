<?php
namespace Desmond;
use Desmond\data_types\IntegerType;
use Desmond\data_types\TrueType;

class Evaluator
{
    private static $FUNCTIONS = [
        '+' => 'Desmond\addition',
        '-' => 'Desmond\subtraction',
        '*' => 'Desmond\multiplication',
        '/' => 'Desmond\division',
        'print' => 'Desmond\desmondPrint'
    ];

    public function getReturn($ast)
    {
        if (!is_array($ast)) {
            return $ast;
        } else { // Form
            $function = $ast[0];
            array_shift($ast);
            foreach ($ast as $formIndex => $atom) {
                if (is_array($atom)) { // Sub form
                    $ast[$formIndex] = $this->getReturn($atom);
                }
            }

            return self::$FUNCTIONS[$function->name()]($ast);
        }
    }
}

function addition($args)
{
    $value = 0;
    foreach ($args as $arg) {
        $value += $arg->value();
    }
    return new IntegerType($value);
}

function subtraction($args)
{
    $value = $args[0]->value();
    array_shift($args);
    foreach ($args as $number) {
        $value -= $number->value();
    }
    return new IntegerType($value);
}

function multiplication($args)
{
    $value = $args[0]->value();
    array_shift($args);
    foreach ($args as $number) {
        $value *= $number->value();
    }
    return new IntegerType($value);
}

function division($args)
{
    $value = $args[0]->value();
    array_shift($args);
    foreach ($args as $number) {
        $value /= $number->value();
    }
    return new IntegerType($value);
}

function desmondPrint($string)
{
    print($string[0]->value());
    return new TrueType(true);
}
