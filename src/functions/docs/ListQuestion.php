<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class ListQuestion implements Doc
{
    public function id()
    {
        return 'list?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a List, otherwise FALSE.';
    }

    public function usage()
    {
        return '(list? <collection:Mixed>)';
    }

    public function examples()
    {
        return [
            '(list? (list 1 2 3))'
        ];
    }
}