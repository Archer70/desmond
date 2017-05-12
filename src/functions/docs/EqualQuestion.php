<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class EqualQuestion implements Doc
{
    public function id()
    {
        return 'equal?';
    }

    public function synopsis()
    {
        return 'Identical to "=" function.';
    }

    public function usage()
    {
        return '(equal? <Mixed> <Mixed>)';
    }

    public function examples()
    {
        return [
            '(equal? 1 1)'
        ];
    }
}