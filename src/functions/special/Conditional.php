<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\NilType;

class Conditional implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        $condition = $this->eval->getReturn($args[0])->value();
        if ($condition !== null && $condition !== false) {
            return $this->eval->getReturn($args[1]);
        } else {
            return isset($args[2]) ? $this->eval->getReturn($args[2]) : new NilType();
        }
    }
}
