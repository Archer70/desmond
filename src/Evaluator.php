<?php
namespace Desmond;
use Desmond\functions\Core;
use Desmond\data_types\ListType;
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

        if ($ast instanceof ListType) {
            return $this->evalForm($ast);
        } else { // Form
            return $this->evalAtom($ast);
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
        $function = $form->getFunction();
        $args = $form->getArgs();
        if ($function->value() == 'define') {
            $this->coreEnv->set($args[0]->value(), $args[1]);
            return $args[1];
        }
        foreach ($args as $formIndex => $atom) {
            if ($atom instanceof ListType) { // Sub form
                $args[$formIndex] = $this->getReturn($atom);
            }
        }
        $actualFunction = $this->coreEnv->get($function->value());
        return call_user_func($actualFunction, $args);
    }
}
