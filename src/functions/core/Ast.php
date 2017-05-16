<?php
namespace Desmond\functions\core;
use Desmond\Lexer;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;

class Ast implements DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'ast';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'ast',
            [0 => ['String']],
            $args
        );
        $string = $args[0];
        $lexer = new Lexer();
        return $lexer->readString($string->value());
    }
}
