<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class HashQuestion implements Doc
{
    public function id()
    {
        return 'hash?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a Hash, otherwise FALSE.';
    }

    public function usage()
    {
        return '(hash? <collection:MIXED>)';
    }

    public function examples()
    {
        return [
            '(hash? {})'
        ];
    }
}