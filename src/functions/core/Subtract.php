<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\NumberType;

class Subtract extends DesmondFunction
{
    public function id()
    {
        return '-';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            return new NumberType(0);
        }
        $value = $args[0]->value();
        array_shift($args);
        if (empty($args)) {
            return new NumberType($value - $value - $value);
        }
        foreach ($args as $number) {
            $value -= $number->value();
        }
        return new NumberType($value);
    }
}
