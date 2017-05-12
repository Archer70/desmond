<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Equal implements Doc
{
    public function id()
    {
        return '=';
    }

    public function synopsis()
    {
        return 'Returns true if all arguments are of equal value. Otherwise returns false.';
    }

    public function usage()
    {
        return '(= <Mixed> <Mixed>..)';
    }

    public function examples()
    {
        return [
            '(= 1 1)',
            '(= "Yes" "No")'
        ];
    }
}