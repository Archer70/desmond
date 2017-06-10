<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class NilQuestion implements Doc
{
    public function id()
    {
        return 'nil?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is Nil, otherwise FALSE.';
    }

    public function usage()
    {
        return '(nil? <thing:Mixed>)';
    }

    public function examples()
    {
        return [
            '(nil? nil)'
        ];
    }
}