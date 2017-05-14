<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class First implements Doc
{
    public function id()
    {
        return 'first';
    }

    public function synopsis()
    {
        return 'Gets the first value from a collection.';
    }

    public function usage()
    {
        return '(first <coll:Vector|Hash|List>)';
    }

    public function examples()
    {
        return [
            '(first [1 2 3])'
        ];
    }
}