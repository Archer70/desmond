<?php
namespace Desmond\functions;
use Desmond\data_types\StringType;

abstract class DesmondSpecialFunction
{
    public $function;
    public $currentEnv;
    public $eval;
    abstract public function run(array $args);

    public function __toString()
    {
        return '#<function> ' . $this->id();
    }

    public function value()
    {
        return new StringType('#<function> ' . $this->id());
    }
}
