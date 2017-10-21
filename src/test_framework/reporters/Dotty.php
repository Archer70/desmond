<?php
namespace Desmond\test_framework\reporters;

class Dotty implements BaseReporter
{
    public function id()
    {
        return 'dotty';
    }

    public function header()
    {
        echo "Running tests...\n";
    }

    public function pass($testName)
    {
        echo '.';
    }

    public function fail($testName, $expected, $actual, $message='')
    {
        echo "\n\nFAILURE: $testName\nexpected: $expected\nactual: $actual";
        if ($message) {
            echo "\nmessage: \"$message\"";
        }
    }

    public function footer()
    {
        echo "0 tests run.\n";
    }
}