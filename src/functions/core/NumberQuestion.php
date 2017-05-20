<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class NumberQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'number?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"number?" expects an argument.');
        }
        return $this->isDesmondType('Number', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
