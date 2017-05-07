<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Help implements Doc
{
    public function id()
    {
        return 'help';
    }

    public function synopsis()
    {
        return 'Returns the help text for a function.
M E T A
E
T
A
-';
    }

    public function usage()
    {
        return '(help <String>)';
    }

    public function examples()
    {
        return [
            '(help "+")'
        ];
    }
}
