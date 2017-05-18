<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class DoBlock implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        $last = end($args);
        array_pop($args);
        foreach($args as $arg) {
            $this->eval->getReturn($arg);
        }
        return $this->eval->getReturn($last);
    }
}
