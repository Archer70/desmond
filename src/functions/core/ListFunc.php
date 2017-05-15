<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ListType;

class ListFunc implements DesmondFunction
{
    public function id()
    {
        return 'list';
    }

    public function run(array $args)
    {
        $list = new ListType();
        foreach ($args as $arg) {
            $list->set($arg);
        }
        return $list;
    }
}
