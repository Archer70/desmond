<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Pop extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'pop';
    }

    public function run(array $args)
    {
        $this->expectArguments('pop', [['List', 'Vector', 'Hash']], $args);
        $array = $args[0]->value();
        array_pop($array);
        return $this->newReturnType('Vector', $array);
    }
}
