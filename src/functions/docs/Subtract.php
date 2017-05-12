<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Subtract implements Doc
{
    public function id()
    {
        return '-';
    }

    public function synopsis()
    {
        return 'Subtracts two or more numbers and returns the result.';
    }

    public function usage()
    {
        return '(- <Number> <Number>..)';
    }

    public function examples()
    {
        return [
            '(- 10 5)',
            '(- 0 5)'
        ];
    }
}