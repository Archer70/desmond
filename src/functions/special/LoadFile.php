<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\functions\core\FileContents;
use Desmond\functions\core\Ast;
use Desmond\data_types\StringType;

class LoadFile implements DesmondSpecialFunction
{
    public static function run(array $args, $function, &$env, $eval)
    {
        $contents = FileContents::run([$args[0]]);
        $contents = sprintf('(do %s)', $contents->value());
        $ast = Ast::run([new StringType($contents)]);
        return $eval->getReturn($ast);
    }
}
