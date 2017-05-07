<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class ListFunc implements Doc
{
    public function id()
    {
        return 'list';
    }

    public function synopsis()
    {
        return 'Returns a new list with the given arguments as its contents. Useful for creating lists that aren\'t evaluated as functions.';
    }

    public function usage()
    {
        return '(list <Mixed>..)';
    }

    public function examples()
    {
        return [
            '(list 1 2 3)'
        ];
    }
}
