<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\AbstractCollection;

class First extends DesmondFunction
{
    use ArgumentHelper;
    
    public function id()
    {
        return 'first';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'first',
            [0 => ['List', 'Vector', 'Hash']],
            $args
        );
        return $args[0]->first();
    }
}
