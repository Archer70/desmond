<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\StringType;
use Desmond\exceptions\ArgumentException;

class TryCatch extends DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $this->checkForm($args);
        $statement = $args[0];
        $catch = $args[1];
        $messageSym = $catch->get(1)->value();
        $body = $catch->get(2);
        try {
            $first = $this->eval->getReturn($statement);
        } catch (\Exception $message) {
            $newId = $this->currentEnv->makeChild();
            $this->currentEnv = $this->currentEnv->values[$newId];

            $this->currentEnv->set(
                $messageSym,
                new StringType($message->getMessage(), true)
            );
            $return = $this->eval->getReturn($body);

            $this->currentEnv = $this->currentEnv->getParent();
            $this->currentEnv->destroyChild($newId);
            return $return;
        }
        return $first;
    }

    private function checkForm($args)
    {
        if (empty($args)) {
            throw new ArgumentException('"try" expects first argument.');
        }
        $this->expectArguments('try', [1 => ['List']], $args);
        $list = $args[1];
        if ($list->getFunction() != 'catch') {
            throw new ArgumentException('"try" expects argument 2 to be a "catch" function.');
        }
        $catchArgs = $list->getArgs();
        $this->expectArguments('catch', [['Symbol']], $catchArgs);
        if (!isset($catchArgs[1])) {
            throw new ArgumentException('"catch" expects argument 2.');
        }
    }
}
