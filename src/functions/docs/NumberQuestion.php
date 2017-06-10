<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class NumberQuestion implements Doc
{
    public function id()
    {
        return 'number?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is an integer or float, otherwise FALSE.';
    }

    public function usage()
    {
        return '(number? <number:Mixed>)';
    }

    public function examples()
    {
        return [
            '(number? 1)',
            '(number? 4.20)'
        ];
    }
}