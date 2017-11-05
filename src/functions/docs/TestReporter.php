<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class TestReporter implements Doc
{
    public function id()
    {
        return 'test-reporter';
    }

    public function synopsis()
    {
        return 'Returns the name of the current test reporter.';
    }

    public function usage()
    {
        return '(test-reporter)';
    }

    public function examples()
    {
        return [
            '(test-reporter)'
        ];
    }
}