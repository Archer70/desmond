<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Debug implements Doc
{
    public function id()
    {
        return 'debug';
    }

    public function synopsis()
    {
        return 'Returns the textual representation of a Desmond data type.';
    }

    public function usage()
    {
        return '(debug <data:Mixed>)';
    }

    public function examples()
    {
        return [
            '(debug [1 2 3])'
        ];
    }
}