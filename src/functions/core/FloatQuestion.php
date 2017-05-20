<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class FloatQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'float?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"float?" expects an argument.');
        }
        return $this->isDesmondType('Number', $args[0]) && is_float($args[0]->value())
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
