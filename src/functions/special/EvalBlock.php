<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\NilType;

class EvalBlock implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        if (empty($args)) {
            return new NilType();
        }
        $return = $this->eval->getReturn($args[0]);
        return $this->eval->getReturn($return);
    }
}
