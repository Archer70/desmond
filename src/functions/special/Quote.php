<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;

class Quote implements DesmondSpecialFunction
{
    public function run(array $args)
    {
        return $args[0];
    }
}
