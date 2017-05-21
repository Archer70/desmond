<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Append extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'append';
    }

    public function run(array $args)
    {
        $this->expectArguments('append', [['Vector', 'List']], $args);
        if (!isset($args[1])) {
            throw new ArgumentException('"append" expects a second argment.');
        }
        $args[0]->set($args[1]);
        return $args[0];
    }
}
