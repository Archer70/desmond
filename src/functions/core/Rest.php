<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\exceptions\ArgumentException;
use Desmond\data_types\AbstractCollection;
use Desmond\data_types\VectorType;
use Desmond\data_types\HashType;
use Desmond\data_types\ListType;

class Rest implements DesmondFunction
{
    use \Desmond\TypeHelper;

    public static function id()
    {
        return 'rest';
    }

    public static function run(array $args)
    {
        if (!isset($args[0])|| !($args[0] instanceof AbstractCollection)) {
            throw new ArgumentException('Rest expects argument to be a collection.');
        }
        return new VectorType(array_values($args[0]->rest()));
    }
}
