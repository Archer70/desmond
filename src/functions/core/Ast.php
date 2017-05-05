<?php
namespace Desmond\functions\core;
use Desmond\Lexer;
use Desmond\functions\DesmondFunction;

class Ast implements DesmondFunction
{
    public static function id()
    {
        return 'ast';
    }

    public static function run(array $args)
    {
        $string = $args[0];
        $lexer = new Lexer();
        return $lexer->readString($string->value());
    }
}
