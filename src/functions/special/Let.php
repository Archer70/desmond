<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class Let implements DesmondSpecialFunction
{
    public function run(array $args)
    {
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
