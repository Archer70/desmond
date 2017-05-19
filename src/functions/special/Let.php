<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Let implements DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $this->expectArguments('let', [['Hash']], $args);
        if (!isset($args[1])) {
            throw new ArgumentException('"let" expects a second argument.');
        }
        $hash = $args[0];
        $function = $args[1];
        $newEnvId = $this->currentEnv->makeChild();

        $this->currentEnv = $this->currentEnv->values[$newEnvId];
        foreach ($hash->value() as $key => $val) {
            $this->currentEnv->set($key, $this->eval->getReturn($val));
        }
        $funcVal = $this->eval->getReturn($function);

        $this->currentEnv = $this->currentEnv->getParent();
        $this->currentEnv->destroyChild($newEnvId);
        return $funcVal;
    }
}
