<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\LambdaType;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class CreateLambda implements DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $this->expectArguments('lambda', [['Vector']], $args);
        if (!isset($args[1])) {
            throw new ArgumentException('"lambda" expects argument 1 to be a function body.');
        }
        return new LambdaType($this->eval, $args[0], $args[1]);
    }
}
