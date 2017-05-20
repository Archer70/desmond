<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class StringQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'string?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"string?" expects an argument.');
        }
        return $this->isDesmondType('String', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
