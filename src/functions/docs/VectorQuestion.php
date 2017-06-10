<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class VectorQuestion implements Doc
{
    public function id()
    {
        return 'vector?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a Vector, otherwise FALSE.';
    }

    public function usage()
    {
        return '(vector? <collection:Mixed>)';
    }

    public function examples()
    {
        return [
            '(vector? [])'
        ];
    }
}