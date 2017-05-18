<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\AbstractCollection;
use Desmond\data_types\NumberType;
use Desmond\data_types\StringType;
use Desmond\data_types\SymbolType;
use Desmond\exceptions\ArgumentException;

class Get extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'get';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'get',
            [0 => ['List', 'Vector', 'Hash'], 1 => ['Number', 'Symbol', 'String']],
            $args
        );
        return $args[0]->get($args[1]->value());
    }
}
