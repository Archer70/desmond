<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\data_types\ListType;

class Quasiquote implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $arg = $args[0];
        $isList = $arg instanceof ListType;
        if ($isList && !empty($arg->value())) {
            $list = $arg;
            foreach ($list->value() as $index => $element) {
                if ($element->value() == 'unquote') {
                    $newValue = $eval->getReturn($list->rest()[0]);
                    $list = $newValue;
                }
                else if ($element instanceof ListType && !empty($element->value())) {
                    if ($element->first()->value() == 'unquote') {
                        $newValue = $eval->getReturn($element->rest()[0]);
                        $list->set($newValue, $index);
                    }
                }
            }
        }
        return isset($list) ? Quote::run([$list], $function, $env, $eval) : Quote::run($args, $function, $env, $eval);
    }
}
