<?php
namespace Desmond;
use Desmond\functions\EnvLoader;
use Desmond\data_types\ListType;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\LambdaType;
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

    private function doSpecialForm($function, $args)
    {
        $possibilities = [
            [$function == 'quote', 'Quote'],
            [$function == 'quasiquote', 'Quasiquote'],
            [$function == 'define', 'DefineSymbol'],
            [$function == 'let', 'Let'],
            [$function == 'do', 'DoBlock'],
            [$function == 'if', 'Conditional'],
            [$function == 'lambda', 'CreateLambda'],
            [($function instanceof LambdaType), 'RunLambda'],
            [$function == 'load-file', 'LoadFile'],
            [$function == 'eval', 'EvalBlock'],
            [true, 'EnvironmentFunction']
        ];
        foreach ($possibilities as $possibility) {
            if ($possibility[0]) {
                return call_user_func_array(
                    "Desmond\\functions\\special\\{$possibility[1]}::run",
                    [$args, $function, &$this->currentEnv, $this]);
            }
        }
    }

    private function evalAtom($atom)
    {
        if (!($atom instanceof SymbolType)) {
            return $atom;
        }
        try {
            $value = $this->currentEnv->get($atom->value());
            return $value;
        } catch (Exception $exeption) {
            return $atom;
        }
    }
}
