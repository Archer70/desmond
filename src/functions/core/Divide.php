<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\NumberType;

class Divide implements DesmondFunction
{
    public function id()
    {
        return '/';
    }

    public function run(array $args)
    {
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            $value /= $number->value();
        }
        return new NumberType($value);
    }
}
