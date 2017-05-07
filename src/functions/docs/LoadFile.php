<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class LoadFile implements Doc
{
    public function id()
    {
        return 'load-file';
    }

    public function synopsis()
    {
        return 'Loads a desmond code file and executes its contents.';
    }

    public function usage()
    {
        return '(load-file <String>)';
    }

    public function examples()
    {
        return [
            '(load-file "path/to/code-file.dsmnd")'
        ];
    }
}