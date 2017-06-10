<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Str implements Doc
{
    public function id()
    {
        return 'str';
    }

    public function synopsis()
    {
        return 'Returns a String with all the supplied arguments appended to it.';
    }

    public function usage()
    {
        return '(str <element:Mixed>...)';
    }

    public function examples()
    {
        return [
            '(str "hello, " name "!") #> hello, Desmond!'
        ];
    }
}