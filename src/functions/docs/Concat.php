<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Concat implements Doc
{
    public function id()
    {
        return 'concat';
    }

    public function synopsis()
    {
        return 'Takes a series of lists and merges them into one.';
    }

    public function usage()
    {
        return '(concat <List>..)';
    }

    public function examples()
    {
        return [
            '(concat (1 2) (3 4))'
        ];
    }
}