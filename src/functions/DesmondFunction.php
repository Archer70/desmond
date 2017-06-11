<?php
namespace Desmond\functions;
use Desmond\data_types\StringType;

abstract class DesmondFunction
{
    abstract public function id();
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
