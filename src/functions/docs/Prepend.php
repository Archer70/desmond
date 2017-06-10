<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Prepend implements Doc
{
    public function id()
    {
        return 'prepend';
    }

    public function synopsis()
    {
        return 'Returns a new Vector containing the elements of a supplied collection, plus another supplied element prepended to it.';
    }

    public function usage()
    {
        return '(prepend <collection:List|Vector> <element:Mixed>)';
    }

    public function examples()
    {
        return [
            '(prepend [2 3] 1)'
        ];
    }
}