<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\NilType;

class DoBlock implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        if (empty($args)) {
            return new NilType();
        }
        $last = end($args);
        array_pop($args);
        foreach($args as $arg) {
            $this->eval->getReturn($arg);
        }
        return $this->eval->getReturn($last);
    }
}
