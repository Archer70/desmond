<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Prepend extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'prepend';
    }

    public function run(array $args)
    {
        $this->expectArguments('prepend', [['Vector', 'List']], $args);
        if (!isset($args[1])) {
            throw new ArgumentException('"prepend" expects a second argument.');
        }
        $collection = clone($args[0]);
        $collection->prepend($args[1]);
        return $collection;
    }
}
