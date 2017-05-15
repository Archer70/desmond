<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ObjectType;
use Desmond\exceptions\ArgumentException;
use Exception;

class DotMethod implements DesmondFunction
{
    use \Desmond\TypeHelper;
    public function id()
    {
        return '.method';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            self::firstArgumentException();
        }
        $object = $args[0]->value();
        if (is_string($object) && strpos($object, '::')) {
            return self::callStaticMethod($object, $args);
        } else if (is_object($object)) {
            return self::callInstanceMethod($object, $args);
        } else {
            self::firstArgumentException();
        }
    }

    private static function callInstanceMethod($object, $args)
    {
        if (!isset($args[1])) {
            self::methodNotFound();
        }
        $method = $args[1]->value();
        if (!method_exists($object, $method)) {
            self::methodNotFound();
        }
        $methodArgs = array_slice($args, 2);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        return self::fromPhpType($object->$method(...$methodArgs));
    }

    private static function callStaticMethod($method, $args)
    {
        $parts = explode('::', $method);
        if (!class_exists($parts[0])) {
            self::firstArgumentException();
        }
        if (!method_exists($parts[0], $parts[1])) {
            throw new ArgumentException('Method "' . $parts[1] . '" not found in class "' . $parts[0] . '".');
        }
        $methodArgs = array_slice($args, 1);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        return self::fromPhpType($method(...$methodArgs));
    }

    private static function firstArgumentException()
    {
        throw new ArgumentException('First argument must be an object or Class::method.');
    }

    private static function methodNotFound()
    {
        throw new ArgumentException('Method not found in object.');
    }
}
