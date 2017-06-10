<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class IntQuestion implements Doc
{
    public function id()
    {
        return 'int?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is an integer, otherwise FALSE.';
    }

    public function usage()
    {
        return '(int? <number:Mixed>)';
    }

    public function examples()
    {
        return [
            '(int? 5)'
        ];
    }
}