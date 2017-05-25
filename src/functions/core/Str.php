<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Str extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'str';
    }

    public function run(array $args)
    {
        $string = '';
        foreach ($args as $arg) {
            $string .= $arg->__toString();
        }
        return $this->newReturnType('String', $string);
    }
}
