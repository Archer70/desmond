<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Ast implements Doc
{
    public function id()
    {
        return 'ast';
    }

    public function synopsis()
    {
        return 'Reads a code string and returns the abstract syntax tree in list form.';
    }

    public function usage()
    {
        return '(ast <String>)';
    }

    public function examples()
    {
        return [
            '(ast "(+ 1 2"))'
        ];
    }
}
