<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotMethod implements Doc
{
    public function id()
    {
        return '.method';
    }

    public function synopsis()
    {
        return 'Calls a method on an object or class.';
    }

    public function usage()
    {
        return '(.method <object:Symbol|String> <method:Symbol|String> <args:Mixed>...)';
    }

    public function examples()
    {
        return [
            '(.method object-instance my-method "arg" "arg2")',
            '(.method MyClass::staticMethod "arg" "arg2")'
        ];
    }
}