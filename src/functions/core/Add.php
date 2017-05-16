<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Add implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '+';
    }

    public function run(array $args)
    {
        $value = 0;
        foreach ($args as $arg) {
            if (!$this->isDesmondType('Number', $arg)) {
                throw new ArgumentException('"+" expects arguments to be Numbers.');
            }
            $value += $arg->value();
        }
        return $this->newReturnType('Number', abs($value));
    }
}
