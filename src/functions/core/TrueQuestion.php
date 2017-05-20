<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class TrueQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'true?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"true?" expects an argument.');
        }
        return $this->isDesmondType('True', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
