<?php
namespace Desmond;
use Desmond\functions\EnvLoader;
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
        EnvLoader::loadInto($this->coreEnv, 'core');
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
        return $actualFunction::run($args);
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
        $contents = \Desmond\functions\core\FileContents::run([$args[0]]);
        $contents = sprintf('(do %s)', $contents->value());
        $ast = \Desmond\functions\core\Ast::run([new StringType($contents)]);
        return $this->getReturn($ast);
    }

    public function doEval($args)
    {
        $return = $this->getReturn($args[0]);
        return $this->getReturn($return);
    }

    private function quasiquote($args)
    {
        $arg = $args[0];
        $isList = $arg instanceof ListType;
        if ($isList && !empty($arg->value())) {
            $list = $arg;
            foreach ($list->value() as $index => $element) {
                if ($element->value() == 'unquote') {
                    $newValue = $this->getReturn($list->rest()[0]);
                    $list = $newValue;
                }
                else if ($element instanceof ListType && !empty($element->value())) {
                    if ($element->first()->value() == 'unquote') {
                        $newValue = $this->getReturn($element->rest()[0]);
                        $list->set($newValue, $index);
                    }
                }
            }
        }
        return isset($list) ? $this->quote([$list]) : $this->quote($args);
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
