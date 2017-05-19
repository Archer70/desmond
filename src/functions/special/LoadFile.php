<?php
namespace Desmond\functions\special;
use Desmond\functions\DesmondSpecialFunction;
use Desmond\ArgumentHelper;
use Desmond\functions\core\FileContents;
use Desmond\functions\core\Ast;
use Desmond\data_types\StringType;

class LoadFile implements DesmondSpecialFunction
{
    use ArgumentHelper;

    public function run(array $args)
    {
        $this->expectArguments('load-file', [['Symbol', 'String']], $args);
        $fileContents = new FileContents;
        $contents = $fileContents->run([$args[0]]);
        $contents = sprintf('(do %s)', $contents->value());
        $ast = new Ast;
        $ast = $ast->run([new StringType($contents, true)]);
        return $this->eval->getReturn($ast);
    }
}
