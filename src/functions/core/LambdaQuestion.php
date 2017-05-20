<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class LambdaQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'lambda?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"lambda?" expects an argument.');
        }
        return $this->isDesmondType('Lambda', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
