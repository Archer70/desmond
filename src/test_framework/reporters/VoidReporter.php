<?php
namespace Desmond\test_framework\reporters;

class VoidReporter implements BaseReporter
{
    public static function reset()
    {}

    public static function id()
    {
        return 'void';
    }

    public static function header()
    {}

    public static function pass($testName)
    {}

    public static function fail($testName, $expected, $actual, $message='')
    {}

    public static function failures()
    {}

    public static function footer()
    {}
}