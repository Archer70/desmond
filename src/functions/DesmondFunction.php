<?php
namespace Desmond\functions;

abstract class DesmondFunction
{
    abstract public function id();
    abstract public function run(array $args);

    public function __toString()
    {
        return "#<function>";
    }

    public function value()
    {
        return 'core-func: ' . $this->id();
    }
}
