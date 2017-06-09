<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\Autoload as Loader;

class Autoload extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'autoload';
    }

    public function run(array $args)
    {
        $this->expectArguments('autoload', [['Lambda']], $args);
        Loader::register($args[0]);
    }
}
