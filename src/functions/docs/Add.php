<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Add implements Doc
{
    public function id()
    {
        return '+';
    }

    public function synopsis()
    {
        return 'Adds a series of numbers and returns the total.';
    }

    public function usage()
    {
        return '(+ <Number> <Number>...)';
    }

    public function examples()
    {
        return [
            '(+ 1 2)',
            '(+ 1 2 3)'
        ];
    }
}
