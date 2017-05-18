<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

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
            [0 => ['List', 'Vector', 'Hash'], 1 => ['Lambda']],
            $args
        );
    }
}
