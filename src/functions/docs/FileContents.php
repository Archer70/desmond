<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class FileContents implements Doc
{
    public function id()
    {
        return 'file-contents';
    }

    public function synopsis()
    {
        return 'Reads a file\'s contents into a string and returns it.';
    }

    public function usage()
    {
        return '(file-contents <String>)';
    }

    public function examples()
    {
        return [
            '(file-contents "path/to/file.dsmnd")'
        ];
    }
}