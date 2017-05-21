<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Not extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'not';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            return $this->newReturnType('True');
        }
        return $this->isDesmondType('True', $args[0])
            ? $this->newReturnType('False')
            : $this->newReturnType('True');
    }
}
