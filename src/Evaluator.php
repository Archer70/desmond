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
            return $this->evalAtom($ast);
        } else { // Form
            return $this->evalForm($ast);
        }
    }

    private function evalAtom($atom)
    {
        try {
            $value = $this->coreEnv->get($atom->value());
            if ($value) {
                return $value;
            };
        } catch (Exception $exeption) {
            return $atom;
        }
    }

    private function evalForm($form)
    {
        $function = $form[0];
        array_shift($form);
        if ($function->value() == 'define') {
            $this->coreEnv->set($form[0]->value(), $form[1]);
            return $form[1];
        }
        foreach ($form as $formIndex => $atom) {
            if (is_array($atom)) { // Sub form
                $form[$formIndex] = $this->getReturn($atom);
            }
        }
        $actualFunction = $this->coreEnv->get($function->value());
        return call_user_func($actualFunction, $form);
    }
}
