<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class FalseQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'false?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"false?" expects an argument.');
        }
        return $this->isDesmondType('False', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
