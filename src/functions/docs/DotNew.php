<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotNew implements Doc
{
    public function id()
    {
        return '.new';
    }

    public function synopsis()
    {
        return 'Creates an instance of a PHP class.';
    }

    public function usage()
    {
        return '(.new <object:Symbol|String> <args|Mixed>...)';
    }

    public function examples()
    {
        return [
            '(.new MyObject)',
            '(.new \\MyNamespace\\Classes\\MyObject)',
            '(.new MyObject "arg" "arg2")'
        ];
    }
}