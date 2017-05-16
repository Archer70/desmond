<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\exceptions\ArgumentException;
use Desmond\ArgumentHelper;

class Divide implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '/';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            '/',
            [0 => ['Number']],
            $args
        );
        $value = $args[0]->value();
        array_shift($args);
        foreach ($args as $number) {
            if (!$this->isDesmondType('Number', $number)) {
                throw new ArgumentException('"/" expects divisors to be Numbers.');
            }
            $value /= $number->value();
        }
        return $this->newReturnType('Number', $value);
    }
}
