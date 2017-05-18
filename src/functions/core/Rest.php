<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\AbstractCollection;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\ListType;

class Rest extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'rest';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'rest',
            [0 => ['List', 'Vector', 'Hash']],
            $args
        );
        return $this->newReturnType('Vector', array_values($args[0]->rest()));
    }
}
