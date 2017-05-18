<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\ListType;

class Quasiquote implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        $arg = $args[0];
        $isList = $arg instanceof ListType;
        if ($isList && !empty($arg->value())) {
            $list = $arg;
            foreach ($list->value() as $index => $element) {
                if ($element->value() == 'unquote') {
                    $newValue = $this->eval->getReturn($list->rest()[0]);
                    $list = $newValue;
                }
                else if ($element instanceof ListType && !empty($element->value())) {
                    if ($element->first()->value() == 'unquote') {
                        $newValue = $this->eval->getReturn($element->rest()[0]);
                        $list->set($newValue, $index);
                    }
                }
            }
        }
        $quote = new Quote();
        return isset($list)
            ? $quote->run([$list], $this->function, $this->currentEnv, $this->eval)
            : $quote->run($args, $this->function, $this->currentEnv, $this->eval);
    }
}
