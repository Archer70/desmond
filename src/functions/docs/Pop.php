<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Pop implements Doc
{
    public function id()
    {
        return 'pop';
    }

    public function synopsis()
    {
        return 'Returns a new Vector with the last element of a collection popped off.';
    }

    public function usage()
    {
        return '(pop <collection:List|Vector>)';
    }

    public function examples()
    {
        return [
            '(pop [1 2 3 4])'
        ];
    }
}