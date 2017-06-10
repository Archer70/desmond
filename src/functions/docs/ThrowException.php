<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class ThrowException implements Doc
{
    public function id()
    {
        return 'throw';
    }

    public function synopsis()
    {
        return 'Throws a new runtime exception.';
    }

    public function usage()
    {
        return '(throw <message:String>)';
    }

    public function examples()
    {
        return [
            '(throw "We tried really hard, but it\'s broken.")'
        ];
    }
}