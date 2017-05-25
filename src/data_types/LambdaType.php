<?php
namespace Desmond\data_types;
use Desmond\Evaluator;
use Desmond\Environment;
use Desmond\functions\DesmondFunction;

class LambdaType extends DesmondFunction
{
    private $evaluator;
    private $environment;
    private $args;
    private $body;

    public function __construct($evaluator, $args, $body)
    {
        $this->evaluator = $evaluator;
        $this->environment = $evaluator->currentEnv;
        $this->args = $args;
        $this->body = $body;
    }

    public function id()
    {
        return 'anonymous';
    }

    public function run(array $params)
    {
        $env = &$this->evaluator->currentEnv;
        $newEnv = $env->makeChild();
        $env = $env->values[$newEnv];
        for ($i=0; $i<$this->args->count(); $i++) {
            $env->set($this->args->get($i)->value(), $params[$i]);
        }
        $funcVal = $this->evaluator->getReturn($this->body);
        $env = $env->getParent();
        $env->destroyChild($newEnv);
        return $funcVal;
    }

    public function __toString()
    {
        return "#<function>";
    }
}
