<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

class Equal implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '=';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            return $this->newReturnType('True');
        }
        $last = $args[0];
        array_shift($args);
        foreach ($args as $arg) {
            if ($arg->value() != $last->value()) {
                return $this->newReturnType('False');
            }
            $last = $arg;
        }
        return $this->newReturnType('True');
    }
}
