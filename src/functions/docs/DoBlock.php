<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DoBlock implements Doc
{
    public function id()
    {
        return 'do';
    }

    public function synopsis()
    {
        return '"Do" a series of things, returning the result of the last operation. Often indicating a change in state is necessary.';
    }

    public function usage()
    {
        return '(do <Mixed>..)';
    }

    public function examples()
    {
        return [
            "(do\n\t\t(define :x 10)\n\t\t(+ 5 :x))"
        ];
    }
}
