<?php
namespace Desmond\test_framework\reporters;

class VoidReporter implements BaseReporter
{
    public function id()
    {
        return 'void';
    }

    public function header()
    {}

    public function pass($testName)
    {}

    public function fail($testName, $expected, $actual, $message='')
    {}

    public function footer()
    {}
}