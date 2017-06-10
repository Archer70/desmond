<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Append implements Doc
{
    public function id()
    {
        return 'append';
    }

    public function synopsis()
    {
        return 'Takes a collection and returns a new one with the supplied element appended to it.';
    }

    public function usage()
    {
        return '(append <collection:List|Vector> <element:Mixed>)';
    }

    public function examples()
    {
        return [
            '(append [1 2] 3)'
        ];
    }
}