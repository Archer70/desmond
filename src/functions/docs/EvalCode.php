<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class EvalCode implements Doc
{
    public function id()
    {
        return 'eval';
    }

    public function synopsis()
    {
        return 'Evaluates an abstract syntax tree. Useful for screwing things up beyond repair and repeatedly shooting yourself in both feet.';
    }

    public function usage()
    {
        return '(eval <Mixed>)';
    }

    public function examples()
    {
        return [
            '(eval (ast "(+ 1 2)"))',
            '(do (define add (ast "(+ 1 2)")) (eval add))'
        ];
    }
}
