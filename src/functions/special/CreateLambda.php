<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\LambdaType;

class CreateLambda implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        return new LambdaType($this->eval, $args[0], $args[1]);
    }
}
