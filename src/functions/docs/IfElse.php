<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class IfElse implements Doc
{
    public function id()
    {
        return 'if';
    }

    public function synopsis()
    {
        return 'If first argument is not False or Nil, evaluate and return the second argument. Othewise evaluate and return the third. If the first argument is False, and there is no third argument, return  Nil.';
    }

    public function usage()
    {
        return '(if <Mixed> <Mixed> <?Mixed>)';
    }

    public function examples()
    {
        return [
            '(if true (print "Yay!"))',
            '(if false (print "Yay!") (print "Oh.."))'
        ];
    }
}