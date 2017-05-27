<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\LiveException;

class ThrowException extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'throw';
    }

    public function run(array $args)
    {
        $this->expectArguments('throw', [['Symbol', 'String']], $args);
        throw new LiveException($args[0]->value());
    }
}
