<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class ObjectQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'object?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"object?" expects an argument.');
        }
        return $this->isDesmondType('Object', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
