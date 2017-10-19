<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class GreaterThanEqualTo implements Doc
{
    public function id()
    {
        return '>=';
    }

    public function synopsis()
    {
        return 'Checks that each consecutive number is less than or equal to the previous one. 2 >= 1 = (>= 2 1)';
    }

    public function usage()
    {
        return '(>= Number...)';
    }

    public function examples()
    {
        return [
            '(>= 2 1)',
            '(>= 3 2 2 1)'
        ];
    }
}