<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class FunctionList implements Doc
{
    public function id()
    {
        return 'function-list';
    }

    public function synopsis()
    {
        return 'Returns a list of all core and special functions.';
    }

    public function usage()
    {
        return '(function-list)';
    }

    public function examples()
    {
        return [
            
        ];
    }
}