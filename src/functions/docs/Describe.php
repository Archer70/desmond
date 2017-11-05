<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Describe implements Doc
{
    public function id()
    {
        return 'describe';
    }

    public function synopsis()
    {
        return 'Descibes a test, or multiple tests with a string that\'s displayed on test output.';
    }

    public function usage()
    {
        return '(describe <description:String>)';
    }

    public function examples()
    {
        return [
            '(describe "basic maths.")
            (assert-equals 1 1)
            (assert-equals 1 2)'
        ];
    }
}