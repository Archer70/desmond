<?php
namespace Desmond;
use Desmond\functions\Core;
use Desmond\data_types\IntegerType;
use Desmond\data_types\TrueType;

class Evaluator
{
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
            return CORE::run($function->name(), $ast);
        }
    }
}
