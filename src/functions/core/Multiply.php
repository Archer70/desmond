<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\NumberType;

class Multiply extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '*';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            return $this->newReturnType('Number', 0);
        }
        $this->expectArguments('*', [0 => ['Number']], $args);
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            if (!$this->isDesmondType('Number', $number)) {
                throw new ArgumentException('"*" expects all arguments to be Numbers.');
            }
            $value *= $number->value();
        }
        return $this->newReturnType('Number', $value);
    }
}
