<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class LessThan implements Doc
{
    public function id()
    {
        return '<';
    }

    public function synopsis()
    {
        return 'Checks that each consecutive number is greater than the previous one. 1 < 2 = (< 1 2)';
    }

    public function usage()
    {
        return '(< Number...)';
    }

    public function examples()
    {
        return [
            '(< 1 2)',
            '(< 1 2 3 4 5)'
        ];
    }
}