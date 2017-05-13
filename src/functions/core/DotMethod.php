<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ObjectType;
use Exception;

class DotMethod implements DesmondFunction
{
    use \Desmond\TypeHelper;
    public static function id()
    {
        return '.method';
    }

    public static function run(array $args)
    {
        $object = $args[0]->value();
        if (strpos('::', $object)) {
            return self::callStaticMethod($object, $args);
        } else {
            return self::callInstanceMethod($object, $args);
        }
    }

    private static function callInstanceMethod($object, $args)
    {
        $method = $args[1]->value();
        $methodArgs = array_slice($args, 2);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        return self::fromPhpType($object->$method(...$methodArgs));
    }

    private static function callStaticMethod($method, $args)
    {
        $methodArgs = array_slice($args, 2);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        $method(...$args);
    }
}
