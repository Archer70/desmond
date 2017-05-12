<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DefineVar implements Doc
{
    public function id()
    {
        return 'define';
    }

    public function synopsis()
    {
        return 'Defines a value to a symbol in the current environment.';
    }

    public function usage()
    {
        return '(define <Symbol> <Mixed>)';
    }

    public function examples()
    {
        return [
            '(define :x 10)',
            '(define my-func (lambda [x y] (+ x y)))'
        ];
    }
}