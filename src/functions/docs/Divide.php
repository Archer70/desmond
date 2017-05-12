<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Divide implements Doc
{
    public function id()
    {
        return '/';
    }

    public function synopsis()
    {
        return 'Takes two or divides them.';
    }

    public function usage()
    {
        return '(/ <Number> <Number>..)';
    }

    public function examples()
    {
        return [
            '(/ 10 5)'
        ];
    }
}