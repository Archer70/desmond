<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Range extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'range';
    }

    public function run(array $args)
    {
        $this->expectArguments('range', [['Number']], $args);
        if (!isset($args[1])) {
            return $this->newReturnType('Vector', range(0, $args[0]->value()));
        }
        if (!$this->isDesmondType('Number', $args[1])) {
            throw new ArgumentException('"range" expects argument 2 to be a Number.');
        }
        return $this->newReturnType('Vector', range($args[0]->value(), $args[1]->value()));
    }
}
