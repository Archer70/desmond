<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class DotNew implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return '.new';
    }

    public function run(array $args)
    {
        if (count($args) == 0) {
            return $this->newReturnType('Object', new \stdClass());
        }
        $this->checkClass($args);
        $object = $args[0]->value();
        $args = $this->getArgValues($args);
        return $this->newReturnType('Object', new $object(...$args));
    }

    private function checkClass($args)
    {
        $this->expectArguments(
            '.new', [0 => ['Symbol', 'String']], $args
        );
        if (!class_exists($args[0]->value())) {
            throw new ArgumentException('".new": Class "' . $args[0]->value() . '" not found.');
        }
    }

    private function getArgValues($args)
    {
        array_shift($args);
        foreach ($args as $key => $arg) {
            $args[$key] = $arg->value();
        }
        return $args;
    }
}
