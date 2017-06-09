<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Join extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'join';
    }

    public function run(array $args)
    {
        $this->expectArguments('join', [['Symbol', 'String'], ['List', 'Vector']], $args);
        $separator = $args[0]->value();
        $collection = $args[1]->value();
        $string = implode($separator, $collection);
        return $this->newReturnType('String', $string);
    }
}
