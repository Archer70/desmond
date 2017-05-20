<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class NilQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'nil?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"nil?" expects an argument.');
        }
        return $this->isDesmondType('Nil', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
