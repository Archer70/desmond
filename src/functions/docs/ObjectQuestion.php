<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class ObjectQuestion implements Doc
{
    public function id()
    {
        return 'object?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argment is an Object, otherwise FALSE.';
    }

    public function usage()
    {
        return '(object? <object:Mixed>)';
    }

    public function examples()
    {
        return [
            '(object? (.new stdClass))'
        ];
    }
}