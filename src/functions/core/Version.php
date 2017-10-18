<?php
namespace Desmond\functions\core;
use Desmond\Desmond;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

class Version extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'version';
    }

    public function run(array $args)
    {
        $versionString = sprintf('Desmond %s, PHP %s.',
            Desmond::VERSION, phpversion());
        return $this->newReturnType('String', $versionString);
    }
}
