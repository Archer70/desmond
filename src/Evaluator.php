<?php
namespace Desmond;
use Desmond\functions\Core;
use Desmond\data_types\IntegerType;
use Desmond\data_types\TrueType;

class Evaluator
{
    public function __construct()
    {
        $this->coreEnv = new Environment();
        Core::loadInto($this->coreEnv);
    }

    public function getReturn($ast)
    {
        if (!is_array($ast)) {
            return $ast;
        } else { // Form
            $function = $ast[0];
            array_shift($ast);
            foreach ($ast as $formIndex => $atom) {
                if (is_array($atom)) { // Sub form
                    $ast[$formIndex] = $this->getReturn($atom);
                }
            }
            $actualFunction = $this->coreEnv->get($function->name());
            return call_user_func($actualFunction, $ast);
        }
    }
}
