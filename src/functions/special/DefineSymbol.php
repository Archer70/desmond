<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class DefineSymbol implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        $value = $this->eval->getReturn($args[1]);
        $this->currentEnv->set($args[0]->value(), $value);
        return $value;
    }
}
