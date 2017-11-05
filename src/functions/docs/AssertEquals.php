<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class AssertEquals implements Doc
{
    public function id()
    {
        return 'assert-equals';
    }

    public function synopsis()
    {
        return 'Asserts that two values are equal.';
    }

    public function usage()
    {
        return '(assert-equals <expected:Mixed> <actual:Mixed> <?message:String>)';
    }

    public function examples()
    {
        return [
            '(assert-equals 1 1)',
            '(assert-equals 1 2 "Not equal.")'
        ];
    }
}