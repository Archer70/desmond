<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class TrueQuestion implements Doc
{
    public function id()
    {
        return 'true?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is TRUE, otherwise FALSE.';
    }

    public function usage()
    {
        return '(true? <bool:Mixed>)';
    }

    public function examples()
    {
        return [
            '(true true)'
        ];
    }
}