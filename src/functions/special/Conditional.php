<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Conditional implements DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        if (!isset($args[0])) {
            throw new ArgumentException('"if" expects first argument condition.');
        } else if (!isset($args[1])) {
            throw new ArgumentException('"if" expects second argument body.');
        }
        $condition = $this->eval->getReturn($args[0])->value();
        if ($condition !== null && $condition !== false) {
            return $this->eval->getReturn($args[1]);
        } else {
            return isset($args[2]) ? $this->eval->getReturn($args[2]) : $this->newReturnType('Nil');
        }
    }
}
