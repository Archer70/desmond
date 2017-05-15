<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\AbstractCollection;

class First implements DesmondFunction
{
    public function id()
    {
        return 'first';
    }

    public function run(array $args)
    {
        if (!isset($args[0])|| !($args[0] instanceof AbstractCollection)) {
            throw new ArgumentException('First expects argument to be a collection.');
        }
        return $args[0]->first();
    }
}
