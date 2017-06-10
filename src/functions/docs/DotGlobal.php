<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotGlobal implements Doc
{
    public function id()
    {
        return '.global';
    }

    public function synopsis()
    {
        return 'Operates on, or retrieves a PHP global variable. WARNING: Changes global state.';
    }

    public function usage()
    {
        return '(.global <name:Symbol|String> <?value:Mixed>)';
    }

    public function examples()
    {
        return [
            '(.global my_var)',
            '(.global my_var "new value")'
        ];
    }
}