<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;

class Equal implements DesmondFunction
{
    public function id()
    {
        return '=';
    }

    public function run(array $args)
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
}
