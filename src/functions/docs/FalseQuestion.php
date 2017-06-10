<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class FalseQuestion implements Doc
{
    public function id()
    {
        return 'false?';
    }

    public function synopsis()
    {
        return 'Returns boolean TRUE if the supplied argument is FALSE, otherwise returns FALSE.';
    }

    public function usage()
    {
        return '(false? <argument:Mixed>)';
    }

    public function examples()
    {
        return [
            '(false? false)',
            '(false? true)'
        ];
    }
}
