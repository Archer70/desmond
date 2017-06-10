<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Split implements Doc
{
    public function id()
    {
        return 'split';
    }

    public function synopsis()
    {
        return 'Returns a Vector containing elements extracted from a String, split by a delimiter.';
    }

    public function usage()
    {
        return '(split <delimiter:Symbol|String> <string:Symbol|String>)';
    }

    public function examples()
    {
        return [
            '(split ",", "1,2,3") #> [1, 2, 3]'
        ];
    }
}