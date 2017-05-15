<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ListType;

class Concat implements DesmondFunction
{
    public function id()
    {
        return 'concat';
    }

    public function run(array $args)
    {
        $newList = new ListType();
        foreach ($args as $list) {
            foreach ($list->value() as $value) {
                $newList->set($value);
            }
        }
        return $newList;
    }
}
