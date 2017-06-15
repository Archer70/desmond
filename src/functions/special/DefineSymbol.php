<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\LambdaType;

class DefineSymbol extends DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $this->expectArguments(
            'define',
            [0 => ['Symbol']],
            $args
        );
        if (!isset($args[1])) {
            throw new ArgumentException('"define" expects second argument.');
        }
        $value = $this->eval->getReturn($args[1]);
        $this->currentEnv->set($args[0]->value(), $value);

        // Update the lambda environment so that it can refer to itself.
        if ($value instanceof LambdaType) {
            $value->updateCreationEnv($this->currentEnv);
        }
        return $value;
    }
}
