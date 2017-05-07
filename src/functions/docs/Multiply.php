<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Multiply implements Doc
{
    public function id()
    {
        return '*';
    }

    public function synopsis()
    {
        return 'Takes two or more numbers and multiplies them, returning the result.';
    }

    public function usage()
    {
        return '(* <Number> <Number>..)';
    }

    public function examples()
    {
        return [
            '(* 2 2)',
            '(* 4.20 10)'
        ];
    }
}