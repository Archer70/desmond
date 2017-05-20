<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class IntQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'int?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"int?" expects an argument.');
        }
        return $this->isDesmondType('Number', $args[0]) && is_int($args[0]->value())
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
