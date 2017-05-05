<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ListType;

class Cons implements DesmondFunction
{
    public static function id()
    {
        return 'cons';
    }

    public static function run(array $args)
    {
        $newList = new ListType([$args[0]]);
        $oldList = $args[1];
        foreach ($oldList->value() as $value) {
            $newList->set($value);
        }
        return $newList;
    }
}
