<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class ChangeTestReporter implements Doc
{
    public function id()
    {
        return 'change-test-reporter';
    }

    public function synopsis()
    {
        return 'Changes the test reporter (the output style).';
    }

    public function usage()
    {
        return '(change-test-reporter <name:String>)';
    }

    public function examples()
    {
        return [
            '(change-test-reporter "dotty")'
        ];
    }
}