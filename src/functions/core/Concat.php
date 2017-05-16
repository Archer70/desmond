<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

class Concat implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'concat';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'concat',
            [0 => ['List'], 1 => ['List']],
            $args
        );
        $newList = $this->newReturnType('List');
        foreach ($args as $list) {
            foreach ($list->value() as $value) {
                $newList->set($value);
            }
        }
        return $newList;
    }
}
