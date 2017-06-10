<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class StringQuestion implements Doc
{
    public function id()
    {
        return 'string?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a String, otherwise FALSE.';
    }

    public function usage()
    {
        return '(string? <element:Mixed>)';
    }

    public function examples()
    {
        return [
            '(string? "")'
        ];
    }
}