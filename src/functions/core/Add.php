<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\NumberType;

class Add implements DesmondFunction
{
    public function id()
    {
        return '+';
    }

    public function run(array $args)
    {
        $value = 0;
        foreach ($args as $arg) {
            $value += $arg->value();
        }
        return new NumberType($value);
    }
}
