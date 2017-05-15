<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\TypeHelper;
use Desmond\exceptions\ArgumentException;

class DotProperty implements DesmondFunction
{
    use ArgumentHelper;
    use TypeHelper;

    public function id()
    {
        return '.property';
    }

    public function run(array $args)
    {
        $this->checkArgs($args);
        $object = $args[0]->value();
        $property = $args[1]->value();

        if (isset($args[2])) {
            $this->setProperty($object, $property, $args[2]);
        }

        if (!$this->isDesmondType('Object', $args[0])) {
            return $this->getStaticProperty($object, $property);
        } else {
            return $this->getInstanceProperty($object, $property);
        }
    }

    private function checkArgs($args)
    {
        $this->expectArguments(
            '.property',
            [
                0 => ['Object', 'String', 'Symbol'],
                1 => ['Symbol', 'String']
            ],
            $args
        );
    }

    private function getStaticProperty($object, $property)
    {
        if (!property_exists($object, $property)) {
            return $this->newReturnType('Nil');
        }
        // Isn't this the cutest thing...
        return TypeHelper::fromPhpType($object::$$property);
    }

    private function getInstanceProperty($object, $property)
    {
        if (!property_exists($object, $property)) {
            return $this->newReturnType('Nil');
        }
        return TypeHelper::fromPhpType($object->$property);
    }

    private function setProperty($object, $property, $value)
    {
        if (is_string($object)) {
            throw new ArgumentException('.property: Static properties cannot be set from an external context.');
        }
        $object->$property = $value->value();
        return $this->newReturnType('Void');
    }
}
