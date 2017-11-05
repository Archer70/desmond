<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class RunTests implements Doc
{
    public function id()
    {
        return 'run-tests';
    }

    public function synopsis()
    {
        return 'Runs test files in a directory.';
    }

    public function usage()
    {
        return '(run-tests <directory:String)';
    }

    public function examples()
    {
        return [
            '(run-tests "test")'
        ];
    }
}