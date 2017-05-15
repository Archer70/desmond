<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\AbstractCollection;
use Desmond\data_types\LambdaType;
use Desmond\data_types\VectorType;
use Desmond\data_types\ListType;
use Desmond\data_types\HashType;

class Map implements DesmondFunction
{
    public function id()
    {
        return 'map';
    }

    public function run(array $args)
    {
        self::requireArgTypes($args);
        $collection = $args[0];
        $values = $collection->value();
        $function = $args[1];
        foreach ($values as $key => $value) {
            $values[$key] = $function->run([$value]);
        }
        return self::returnCollection($collection, $values);
    }

    private static function requireArgTypes(array $args)
    {
        if (!isset($args[0]) || !($args[0] instanceof AbstractCollection)) {
            throw new \Exception('Map requires first argument to be a collection.');
        }
        if (!isset($args[1]) || !($args[1] instanceof LambdaType)) {
            throw new \Exception('Map requires second argument to be a lambda function.');
        }
    }

    private static function returnCollection($collectionType, $collection)
    {
        if ($collectionType instanceof VectorType) {
            return new VectorType($collection);
        } else if ($collectionType instanceof ListType) {
            return new ListType($collection);
        } else {
            return new HashType($collection);
        }
    }
}
