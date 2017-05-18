<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\ListType;
use Desmond\data_types\VectorType;
use Desmond\data_types\NumberType;
use Desmond\data_types\NilType;
use Desmond\exceptions\ArgumentException;

class Nth extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'nth';
    }

    public function run(array $args)
    {
        $this->expectArgs($args);
        $list = $args[0]->value();
        $index = $args[1]->value();
        if (!array_key_exists($index, $list)) {
            return new NilType();
        }
        return $list[$index];
    }

    private function expectArgs($args)
    {
        $this->expectArguments(
            'nth',
            [0 => ['List', 'Vector'], 1 => ['Number']],
            $args
        );
    }
}
