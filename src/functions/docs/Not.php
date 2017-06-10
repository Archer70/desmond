<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Not implements Doc
{
    public function id()
    {
        return 'not';
    }

    public function synopsis()
    {
        return 'Like "!" in PHP. Flips the boolean value of its argument to the opposite.';
    }

    public function usage()
    {
        return '(not <test:True|False>)';
    }

    public function examples()
    {
        return [
            '(not (= 1 2))'
        ];
    }
}