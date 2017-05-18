<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class DPrint extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'print';
    }

    public function run(array $strings)
    {
        $string = '';
        foreach ($strings as $arg) {
            $string .= $arg->__toString();
        }
        print($string);
        return $this->newReturnType('Void');
    }
}
