<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class LessThan extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '<';
    }

    public function run(array $args)
    {
        $this->expectArguments('<', [['Number']], $args);
        $last = $args[0];
        array_shift($args);
        foreach ($args as $number) {
            if (!$this->isDesmondType('Number', $number)) {
                throw new ArgumentException('"<" expects arguments to be numbers.');
            }
            if ($number->value() <= $last->value()) {
                return $this->newReturnType('False');
            }
            $last = $number;
        }
        return $this->newReturnType('True');
    }
}
