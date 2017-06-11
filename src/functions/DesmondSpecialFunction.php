<?php
namespace Desmond\functions;

abstract class DesmondSpecialFunction
{
    public $function;
    public $currentEnv;
    public $eval;
    abstract public function run(array $args);
    public function value()
    {
        return 'lang-func: ' . $this->id();
    }
}
