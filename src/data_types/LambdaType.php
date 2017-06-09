<?php
namespace Desmond\data_types;
use Desmond\Evaluator;
use Desmond\Environment;
use Desmond\functions\DesmondFunction;

class LambdaType extends DesmondFunction
{
    private $evaluator;
    private $preRunEnv;
    private $creationEnv;
    private $functionEnv;
    private $functionEnvId;
    private $args;
    private $body;

    public function __construct($evaluator, $args, $body)
    {
        $this->evaluator = $evaluator;
        $this->creationEnv = clone($evaluator->currentEnv);
        $this->args = $args;
        $this->body = $body;
    }

    public function id()
    {
        return 'anonymous';
    }

    public function run(array $params)
    {
        $this->saveCurrentEnvironment();
        $this->useCreationEnvironment();
        $this->createChildEnvironment();
        for ($i=0; $i<$this->args->count(); $i++) {
            $this->functionEnv->set(
                $this->args->get($i)->value(), $params[$i]);
        }
        $funcVal = $this->evaluator->getReturn($this->body);
        $this->destroyFunctionEnvironment();
        $this->revertToLiveEnvironment();
        return $funcVal;
    }

    private function saveCurrentEnvironment()
    {
        $this->preRunEnv = $this->evaluator->currentEnv;
    }

    public function useCreationEnvironment()
    {
        $this->evaluator->currentEnv = $this->creationEnv;
    }

    private function createChildEnvironment()
    {
        $this->functionEnvId = $this->evaluator->currentEnv->makeChild();
        $this->functionEnv = $this->evaluator->currentEnv->values[$this->functionEnvId];
        $this->evaluator->currentEnv = $this->functionEnv;
    }

    private function destroyFunctionEnvironment()
    {
        $this->evaluator->currentEnv->destroyChild($this->functionEnvId);
    }

    private function revertToLiveEnvironment()
    {
        $this->evaluator->currentEnv = $this->preRunEnv;
    }

    public function __toString()
    {
        return "#<function>";
    }
}
