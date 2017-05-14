<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotFunc implements Doc
{
    public function id()
    {
        return '.func';
    }

    public function synopsis()
    {
        return 'Calls a PHP function and gets its return value converted to a Desmond type.';
    }

    public function usage()
    {
        return '(.func <func-name:String|Symbol> <args|Mixed>...)';
    }

    public function examples()
    {
        return [
            '(.func myFunc "arg1" "arg2")'
        ];
    }
}