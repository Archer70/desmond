<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

class EmptyQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'empty?';
    }

    public function run(array $args)
    {
        return (empty($args)) || empty($args[0]->value())
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
