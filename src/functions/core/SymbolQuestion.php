<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class SymbolQuestion extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'symbol?';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            throw new ArgumentException('"symbol?" expects an argument.');
        }
        return $this->isDesmondType('Symbol', $args[0])
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
