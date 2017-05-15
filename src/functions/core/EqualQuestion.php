<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;

class EqualQuestion implements DesmondFunction
{
    public function id()
    {
        return 'equal?';
    }

    public function run(array $args)
    {
        return Equal::run($args);
    }
}
