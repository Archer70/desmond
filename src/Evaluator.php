<?php
namespace Desmond;
use Desmond\functions\Core as CoreFunctions;
use Desmond\data_types\ListType;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\LambdaType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\IntegerType;
use Desmond\data_types\NilType;
use Exception;

class Evaluator
{
    private $coreEnv;
    public $currentEnv;

    public function __construct()
    {
        $this->coreEnv = new Environment();
        $this->currentEnv = $this->coreEnv;
        CoreFunctions::loadInto($this->coreEnv);
    }

    public function getReturn($ast)
    {
        if ($ast instanceof ListType) {
            return $this->evalForm($ast);
        } else if ($ast instanceof VectorType || $ast instanceof HashType) {
            return $this->evalCollection($ast);
        } else {
            return $this->evalAtom($ast);
        }
    }

    private function evalAtom($atom)
    {
        if (!($atom instanceof SymbolType || $atom instanceof IntegerType)) {
            return $atom;
        }
        try {
            $value = $this->currentEnv->get($atom->value());
            return $value;
        } catch (Exception $exeption) {
            return $atom;
        }
    }

    private function evalForm($form)
    {
        if ($form->get(0) instanceof ListType || $this->getReturn($form->get(0)) instanceof LambdaType) {
            $function = $this->getReturn($form->get(0));
        } else {
            $function = $form->getFunction()->value();
        }
        $args = $form->getArgs();
        if ($function == 'define') {
            return $this->defineVar($args[0], $args[1]);
        } else if ($function == 'let') {
            return $this->doLet($args[0], $args[1]);
        } else if ($function == 'do') {
            return $this->doBlock($args);
        } else if ($function == 'if') {
            return $this->doConditional($args);
        } else if ($function == 'lambda') {
            $lambdaArgs = $args[0];
            $body = $args[1];
            return new LambdaType($this, $lambdaArgs, $body);
        } else if ($function instanceof LambdaType) {
            return $function->run($args);
        } else if ($function == 'eval') {
            $return = $this->getReturn($args[0]);
            return $this->getReturn($return);
        } else {
            return $this->doEnvironmentFunction($function, $args);
        }
    }

    public function evalCollection($ast)
    {
        $collection = $ast;
        foreach ($collection->value() as $key => $value) {
            $collection->set($this->getReturn($value), $key);
        }
        return $collection;
    }

    private function defineVar($name, $var)
    {
        $value = $this->getReturn($var);
        $this->currentEnv->set($name->value(), $value);
        return $value;
    }

    private function doLet($hash, $function)
    {
        $envId = $this->getNewEnvId();
        $newEnv = new Environment($this->currentEnv);
        $previousEnv = $this->currentEnv;
        $this->currentEnv->set($envId, $newEnv);
        $this->currentEnv = $newEnv;
        foreach ($hash->value() as $key => $val) {
            $this->currentEnv->set($key, $this->getReturn($val));
        }
        $funcVal = $this->getReturn($function);
        $this->currentEnv = $previousEnv;
        unset($this->currentEnv->values[$envId]);
        return $funcVal;
    }

    private function doEnvironmentFunction($function, $args)
    {
        foreach ($args as $formIndex => $atom) {
            $args[$formIndex] = $this->getReturn($atom);
        }
        $actualFunction = $this->currentEnv->get($function);
        return call_user_func($actualFunction, $args);
    }

    private function doBlock($args)
    {
        $last = end($args);
        array_pop($args);
        foreach($args as $arg) {
            $this->getReturn($arg);
        }
        return $this->getReturn($last);
    }

    private function doConditional($args)
    {
        $condition = $this->getReturn($args[0])->value();
        if ($condition !== null && $condition !== false) {
            return $this->getReturn($args[1]);
        } else {
            return isset($args[2]) ? $this->getReturn($args[2]) : new NilType();
        }
    }

    public function getNewEnvId()
    {
        do {
            $envId = 'let_' . mt_rand(); // Most probably, this will only happen once.
        } while (array_key_exists($envId, $this->currentEnv->values));
        return $envId;
    }
}
