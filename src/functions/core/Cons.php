<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Cons extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'cons';
    }

    public function run(array $args)
    {
        $this->testArguments($args);
        $newList = $this->newReturnType(
            $this->collectionType($args[1]), [$args[0]]);
        $oldList = $args[1];
        foreach ($oldList->value() as $value) {
            $newList->set($value);
        }
        return $newList;
    }

    public function collectionType($collection)
    {
        return $this->isDesmondType('List', $collection) ? 'List' : 'Vector';
    }

    private function testArguments(array $args)
    {
        if (count($args) !== 2) {
            throw new ArgumentException('"cons" expects 2 arguments.');
        }
        $this->expectArguments(
            'cons',
            [1 => ['List', 'Vector']],
            $args
        );
    }
}
