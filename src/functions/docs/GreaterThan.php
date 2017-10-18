<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class GreaterThan implements Doc
{
    public function id()
    {
        return '>';
    }

    public function synopsis()
    {
        return 'Checks that each consecutive number is less than the previous one. 2 > 1 = (> 2 1)';
    }

    public function usage()
    {
        return '(> Number...)';
    }

    public function examples()
    {
        return [
            '(> 2 1)',
            '(> 5 4 3 2 1)'
        ];
    }
}