<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Map implements Doc
{
    public function id()
    {
        return 'map';
    }

    public function synopsis()
    {
        return 'Applies a lambda function to each element of a collection, returning a new collection with the modified values.';
    }

    public function usage()
    {
        return '(map <collection:List|Vector|Hash> <function:Lambda>)';
    }

    public function examples()
    {
        return [
            '
(map
    [1 2 3]
    (lambda [number]
        (+ 1 number)
    )
)'
        ];
    }
}
