<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\ObjectType;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Exception;

class DotMethod implements DesmondFunction
{
    use \Desmond\TypeHelper;
    use ArgumentHelper;

    public function id()
    {
        return '.method';
    }

    public function run(array $args)
    {
        $this->checkFirstArgument($args);
        $target = $args[0]->value();
        if (is_string($target) && strpos($target, '::')) {
            return $this->callStaticMethod($target, $args);
        } else if (is_object($target)) {
            return $this->callInstanceMethod($target, $args);
        } else {
            throw new ArgumentException("\".method\": First argument must be an object or Class::method.");
        }
    }

    private function checkFirstArgument($args)
    {
        $this->expectArguments(
            '.method',
            [0 => ['Object', 'Symbol', 'String']],
            $args
        );
    }

    private function callInstanceMethod($object, $args)
    {
        $method = $this->getInstanceMethod($args);
        $this->checkInstanceMethodExists($object, $method);
        $methodArgs = array_slice($args, 2);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        return self::fromPhpType($object->$method(...$methodArgs));
    }

    private function getInstanceMethod($args)
    {
        $this->expectArguments(
            '.method',
            [1 => ['Symbol', 'String']],
            $args
        );
        return $args[1]->value();
    }

    private function callStaticMethod($method, $args)
    {
        $this->checkStaticExists($method);
        $methodArgs = array_slice($args, 1);
        foreach ($methodArgs as $key=> $arg) {
            $methodArgs[$key] = $arg->value();
        }
        return self::fromPhpType($method(...$methodArgs));
    }

    private function checkInstanceMethodExists($object, $method)
    {
        if (!method_exists($object, $method)) {
            $objectName = get_class($object);
            throw new ArgumentException("\".method\": Method \"$method\" not found in object \"$objectName\".");
        }
    }

    private function checkStaticExists($method)
    {
        $parts = explode('::', $method);
        if (!class_exists($parts[0])) {
            throw new ArgumentException("\".method\": Class \"{$parts[0]}\" not found.");
        }
        if (!method_exists($parts[0], $parts[1])) {
            throw new ArgumentException('".method": Method "' . $parts[1] . '" not found in class "' . $parts[0] . '".');
        }
    }
}
