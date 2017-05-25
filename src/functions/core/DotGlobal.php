<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\TypeHelper;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class DotGlobal extends DesmondFunction
{
    use TypeHelper;
    use ArgumentHelper;

    public function id()
    {
        return '.global';
    }

    public function run(array $args)
    {
        if (empty($args)) {
            $globals = $this->globalsCopy(); // Recusion kills fromPhpType.
            return self::fromPhpType($globals);
        }
        $this->expectArguments('.post', [['Symbol', 'String']], $args);
        $index = $args[0]->value();
        if (isset($args[1])) {
            $GLOBALS[$index] = $args[1]->value();
        }
        return self::fromPhpType($GLOBALS[$index]);
    }

    private function globalsCopy()
    {
        $globals = [];
        foreach ($GLOBALS as $key => $data) {
            if ($key == 'GLOBALS') {
                continue; // Remove recursive reference.
            }
            $globals[$key] = $data;
        }
        return $globals;
    }
}
