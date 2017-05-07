<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class PrintLine implements Doc
{
    public function id()
    {
        return 'print-line';
    }

    public function synopsis()
    {
        return 'Prints a line of text. Who\'d of seen that coming.';
    }

    public function usage()
    {
        return '(print-line <String>..)';
    }

    public function examples()
    {
        return [
            '(print-line "That\'s what she said.")',
            '(print-line "Hello, " "World!")'
        ];
    }
}