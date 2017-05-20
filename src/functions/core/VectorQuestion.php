<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class VectorQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'vector?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"vector?" expects an argument.');
        }
        return $this->isDesmondType('Vector', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
