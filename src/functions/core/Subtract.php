<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\NumberType;
use Desmond\exceptions\ArgumentException;

class Subtract extends DesmondFunction
{
    public function id()
    {
        return '-';
    }

    public function run(array $args)
    {
        $this->enforceTypes($args);
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

    private function enforceTypes($args)
    {
        foreach ($args as $arg) {
            if (!($arg instanceof NumberType)) {
                throw new ArgumentException('"-" expects arguments to be Numbers.');
            }
        }
    }
}
