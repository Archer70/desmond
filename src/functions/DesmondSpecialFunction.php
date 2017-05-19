<?php
namespace Desmond\functions;

abstract class DesmondSpecialFunction
{
    public $function;
    public $currentEnv;
    public $eval;
    abstract public function run(array $args);
}
