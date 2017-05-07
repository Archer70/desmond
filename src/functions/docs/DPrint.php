<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DPrint implements Doc
{
    public function id()
    {
        return 'print';
    }

    public function synopsis()
    {
        return 'Outputs given string. If more than one string is given, they are joined into one.';
    }

    public function usage()
    {
        return '(print <String>..)';
    }

    public function examples()
    {
        return [
            '(print "Hello!")',
            '(do (define :name "Desmond") (print "Hello, " :name))'
        ];
    }
}