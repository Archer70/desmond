<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Cons implements Doc
{
    public function id()
    {
        return 'cons';
    }

    public function synopsis()
    {
        return 'Prepends an element onto a list.';
    }

    public function usage()
    {
        return '(cons <Mixed> <List>)';
    }

    public function examples()
    {
        return [
            '(cons 1 (list 2 3))'
        ];
    }
}