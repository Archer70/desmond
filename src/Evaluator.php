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
use Desmond\data_types\StringType;
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
        return $this->doSpecialForm($function, $form->getArgs());
    }

    public function evalCollection($ast)
    {
        $collection = $ast;
        foreach ($collection->value() as $key => $value) {
            $collection->set($this->getReturn($value), $key);
        }
        return $collection;
    }

    private function defineVar($args)
    {
        $value = $this->getReturn($args[1]);
        $this->currentEnv->set($args[0]->value(), $value);
        return $value;
    }

    private function doLet($args, $function, &$env)
    {
        $hash = $args[0];
        $function = $args[1];
        $newEnvId = $env->makeChild();

        $env = $env->values[$newEnvId];
        foreach ($hash->value() as $key => $val) {
            $env->set($key, $this->getReturn($val));
        }
        $funcVal = $this->getReturn($function);

        $env = $env->getParent();
        $env->destroyChild($newEnvId);
        return $funcVal;
    }

    private function doEnvironmentFunction($args, $function, $env)
    {
        foreach ($args as $formIndex => $atom) {
            $args[$formIndex] = $this->getReturn($atom);
        }
        $actualFunction = $env->get($function);
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

    private function getLambda($args)
    {
        return new LambdaType($this, $args[0], $args[1]);
    }

    private function doLambda($args, $function)
    {
        foreach ($args as $index => $arg) {
            $args[$index] = $this->getReturn($arg);
        }
        return $function->run($args);
    }

    public function loadFile($args)
    {
        $contents = CoreFunctions::file_contents([$args[0]]);
        $contents = sprintf('(do %s)', $contents->value());
        $ast = CoreFunctions::ast([new StringType($contents)]);
        return $this->getReturn($ast);
    }

    public function doEval($args)
    {
        $return = $this->getReturn($args[0]);
        return $this->getReturn($return);
    }

    private function quasiquote($args)
    {
        $list = $args[0];
        if (!$this->isPair($list)) {
            $newList = new ListType();
            $newList->set(new SymbolType('quote'));
            $newList->set($list);
            return $this->getReturn($newList);
        } else if ($list->get(0)->value() == 'unquote') {
            return $this->getReturn($list->get(1));
        } else if ($this->isPair($list->get(0)) && $list->get(0)->get(0)->value == 'splice-unquote') {
            $newList = new ListType();
            $newList->set(new SymbolType('concat'));
            $newList->set($list->get(0)->get(1));
            $rest = $list->value();
            array_shift($rest);
            $newList->set($this->quasiquote($rest));
            return $this->getReturn($newList);
        } else {
            $newList = new ListType();
            $newList->set(new SymbolType('cons'));
            $newList->set($this->quasiquote($list->value()));
            $rest = $list->value();
            array_shift($rest);
            $newList->set($this->quasiquote($rest));
            return $this->getReturn($newList);
        }
    }

    private function quote($args)
    {
        return $args[0];
    }

    private function isPair($ast)
    {
        return $ast instanceof ListType && !empty($ast->value());
    }

    private function doSpecialForm($function, $args)
    {
        $possibilities = [
            [$function == 'quote', 'quote'],
            [$function == 'quasiquote', 'quasiquote'],
            [$function == 'define', 'defineVar'],
            [$function == 'let', 'doLet'],
            [$function == 'do', 'doBlock'],
            [$function == 'if', 'doConditional'],
            [$function == 'lambda', 'getLambda'],
            [($function instanceof LambdaType), 'doLambda'],
            [$function == 'load-file', 'loadFile'],
            [$function == 'eval', 'doEval'],
            [true, 'doEnvironmentFunction']
        ];
        foreach ($possibilities as $possibility) {
            if ($possibility[0]) {
                return $this->{$possibility[1]}($args, $function, $this->currentEnv);
            }
        }
    }
}
