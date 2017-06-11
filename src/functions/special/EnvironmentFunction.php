<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class EnvironmentFunction extends DesmondSpecialFunction
{
    public function run(array $args)
    {
        foreach ($args as $formIndex => $atom) {
            $args[$formIndex] = $this->eval->getReturn($atom);
        }
        $actualFunction = $this->currentEnv->get($this->function);
        $object = new $actualFunction;
        if (method_exists($object, 'run')) {
            return $object->run($args);
        } else {
            return $object;
        }
    }
}
