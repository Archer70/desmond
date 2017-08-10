<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\functions\FileOperations;

class FunctionList extends DesmondFunction
{
    use \Desmond\TypeHelper;

    public function id()
    {
        return 'function-list';
    }

    public function run(array $args)
    {
        $list = [
            'define', 'let', 'do', 'if',
            'lambda', 'load-file', 'eval',
            'try'
        ];
        foreach (FileOperations::getFunctionFiles() as $file) {
            $class = sprintf('Desmond\\functions\\core\\%s', substr($file, 0, -4));
            $function = new $class;
            $list[] = $function->id();
        }
        return self::fromPhpType($list);
    }
}
