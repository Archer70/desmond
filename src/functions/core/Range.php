<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\data_types\NumberType;
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
            $numbers = $this->getInts(range(0, $args[0]->value()));
            return $this->newReturnType('Vector', $numbers);
        }
        if (!$this->isDesmondType('Number', $args[1])) {
            throw new ArgumentException('"range" expects argument 2 to be a Number.');
        }
        $numbers = $this->getInts(range($args[0]->value(), $args[1]->value()));
        return $this->newReturnType('Vector', $numbers);
    }

    private function getInts($numbers)
    {
        return array_map(function($num) {
            return new NumberType($num);
        }, $numbers);
    }
}
