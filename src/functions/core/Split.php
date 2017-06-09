<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Split extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'split';
    }

    public function run(array $args)
    {
        $this->expectArguments('split', [['Symbol', 'String'], ['Symbol', 'String']], $args);
        $separator = $args[0]->value();
        $string = $args[1]->value();
        $collection = explode($separator, $string);
        return $this->newReturnType('Vector', $collection);
    }
}
