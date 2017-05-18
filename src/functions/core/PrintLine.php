<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\data_types\VoidType;

class PrintLine extends DesmondFunction
{
    public function id()
    {
        return 'print-line';
    }

    public function run(array $strings)
    {
        $printer = new DPrint();
        $printer->run($strings);
        print("\n");
        return new VoidType();
    }
}
