<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class AssertTrue implements Doc
{
    public function id()
    {
        return 'assert-true';
    }

    public function synopsis()
    {
        return 'Asserts that a value is "truthy."';
    }

    public function usage()
    {
        return '(assert-true <value:Mixed> <?message:String>)';
    }

    public function examples()
    {
        return [
            '(assert-true true)',
            '(assert-true :true-val "Hopefully true. :P")'
        ];
    }
}