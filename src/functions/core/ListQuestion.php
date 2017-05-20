<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class ListQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'list?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"list?" expects an argument.');
        }
        return $this->isDesmondType('List', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
