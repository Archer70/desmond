<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\LambdaType;

class RunLambda implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        foreach ($args as $index => $arg) {
            $args[$index] = $this->eval->getReturn($arg);
        }
        return $this->function->run($args);
    }
}
