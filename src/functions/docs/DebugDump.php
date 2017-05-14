<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DebugDump implements Doc
{
    public function id()
    {
        return 'debug-dump';
    }

    public function synopsis()
    {
        return 'Outputs the textual representation of a Desmond data type.';
    }

    public function usage()
    {
        return '(debug-dump <data:Mixed>)';
    }

    public function examples()
    {
        return [
            '(debug-dump [1 2 3])'
        ];
    }
}