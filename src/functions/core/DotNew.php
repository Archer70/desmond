<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\TypeHelper;
use Desmond\data_types\ObjectType;
use Exception;

class DotNew implements DesmondFunction
{
    use TypeHelper;

    public static function id()
    {
        return '.new';
    }

    public static function run(array $args)
    {
        if (count($args) == 0) {
            return new ObjectType(new \stdClass());
        }
        $object = $args[0]->value();
        array_shift($args);
        foreach ($args as $key => $arg) {
            $args[$key] = $arg->value();
        }
        return new ObjectType(new $object(...$args));
    }
}
