<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class LambdaFunction implements Doc
{
    public function id()
    {
        return 'lambda';
    }

    public function synopsis()
    {
        return 'Creates an anonymous function.
The first argument is a Vector containing symbols representing arguments expected to be passed to it.
The second argument is the code to be evaluated when the lambda is called.';
    }

    public function usage()
    {
        return '(lambda <Vector> <Mixed>)';
    }

    public function examples()
    {
        return [
            '(lambda [:x :y] (+ :x :y))'
        ];
    }
}
