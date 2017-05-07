<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\functions\FileOperations;
use Desmond\data_types\ListType;

class FunctionList implements DesmondFunction
{
    public static function id()
    {
        return 'function-list';
    }

    public static function run(array $args)
    {
        $list = [
            'define', 'let', 'do', 'if',
            'lambda', 'load-file', 'eval'
        ];
        foreach (FileOperations::getFunctionFiles() as $file) {
            $class = sprintf('Desmond\\functions\\core\\%s', substr($file, 0, -4));
            $function = new $class;
            $list[] = $function->id();
        }
        return new ListType($list);
    }
}
