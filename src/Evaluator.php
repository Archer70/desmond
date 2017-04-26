<?php
namespace Desmond;
use Desmond\functions\Core;
use Desmond\data_types\IntegerType;
use Desmond\data_types\TrueType;
use Exception;

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
            try {
                $value = $this->coreEnv->get($ast->value());
                if ($value) {
                    return $value;
                };
            } catch (Exception $exeption) {
                return $ast;
            }
        } else { // Form
            $function = $ast[0];
            array_shift($ast);
            if ($function->value() == 'define') {
                $this->coreEnv->set($ast[0]->value(), $ast[1]);
                return new TrueType(true);
            }
            foreach ($ast as $formIndex => $atom) {
                if (is_array($atom)) { // Sub form
                    $ast[$formIndex] = $this->getReturn($atom);
                }
            }
            $actualFunction = $this->coreEnv->get($function->value());
            return call_user_func($actualFunction, $ast);
        }
    }
}
