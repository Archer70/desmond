<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class Set extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'set';
    }

    public function run(array $args)
    {
        $args = $this->cloneArgs($args);
        $this->expectArguments(
            'set',
            [0 => ['Hash'], 1 => ['Number', 'Symbol', 'String']],
            $args
        );
        if (!isset($args[2])) {
            throw new ArgumentException('"set" expects third argument.');
        }
        $newHash = $args[0];
        $newHash->set($args[2], $args[1]->value());
        return $newHash;
    }
}
