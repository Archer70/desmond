<?php
namespace Desmond\functions\special;
use Desmond\DesmondNamespace as NS;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;

class NamespaceBlock extends DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $name = $args[0]->value();
        if (!NS::exists($name)) {
            $newEnv = $this->currentEnv->makeChild();
            $this->currentEnv = $this->currentEnv->values[$newEnv];
            NS::create($name, $this->currentEnv);
        } else {
            $this->currentEnv = NS::get($name);
        }


        $last = end($args);
        array_pop($args);
        array_shift($args);
        foreach($args as $arg) {
            $this->eval->getReturn($arg);
        }
        $return = $this->eval->getReturn($last);

        $this->currentEnv = $this->currentEnv->getParent();
        return $return;
    }
}
