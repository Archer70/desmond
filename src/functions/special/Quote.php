<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class Quote extends DesmondSpecialFunction
{
    public function run(array $args)
    {
        return $args[0];
    }
}
