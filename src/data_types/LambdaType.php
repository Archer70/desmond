<?php
namespace Desmond\data_types;
use Desmond\Evaluator;
use Desmond\Environment;

class LambdaType
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

    public function run($params)
    {
        $envId = $this->evaluator->getNewEnvId();
        $newEnv = new Environment($this->evaluator->currentEnv);
        $previousEnv = $this->evaluator->currentEnv;
        $this->evaluator->currentEnv->set($envId, $newEnv);
        $this->evaluator->currentEnv = $newEnv;
        for ($i=0; $i<$this->args->count(); $i++) {
            $this->evaluator->currentEnv->set($this->args->get($i)->value(), $params[$i]);
        }
        $funcVal = $this->evaluator->getReturn($this->body);
        $this->evaluator->currentEnv = $previousEnv;
        unset($this->evaluator->currentEnv->values[$envId]);
        return $funcVal;
    }

    public function __toString()
    {
        return "#<function>";
    }
}
