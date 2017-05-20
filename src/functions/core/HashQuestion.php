<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class HashQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'hash?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"hash?" expects an argument.');
        }
        return $this->isDesmondType('Hash', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
