<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\functions\core\FileContents;
use Desmond\functions\core\Ast;
use Desmond\data_types\StringType;

class EvalBlock implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        $return = $this->eval->getReturn($args[0]);
        return $this->eval->getReturn($return);
    }
}
