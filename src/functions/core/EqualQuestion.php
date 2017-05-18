<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;

class EqualQuestion extends DesmondFunction
{
    public function id()
    {
        return 'equal?';
    }

    public function run(array $args)
    {
        $equal = new Equal();
        return $equal->run($args);
    }
}
