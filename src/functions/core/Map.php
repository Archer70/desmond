<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Map extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'map';
    }

    public function run(array $args)
    {
        $this->requireArgTypes($args);
        $collection = $args[0];
        $values = $collection->value();
        $function = $args[1];
        foreach ($values as $key => $value) {
            $collection->set(
                $function->run([$value]), $key);
        }
        return $collection;
    }

    private function requireArgTypes(array $args)
    {
        $this->expectArguments(
            'map',
            [['List', 'Vector', 'Hash']],
            $args
        );
        if (!isset($args[1]) || !($args[1] instanceof DesmondFunction)) {
            throw new ArgumentException('"map" expects argument 1 to be a function.');
        }
    }
}
