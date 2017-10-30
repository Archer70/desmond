<?php
namespace Desmond\test_framework\reporters;

class Dotty implements BaseReporter
{
    private static $passed = 0;
    private static $failed = 0;
    private static $failures = [];
    private static $testName = '';

    public static function id()
    {
        return 'dotty';
    }

    public static function setTestName($testName)
    {
        self::$testName = $testName;
    }

    public static function header()
    {
        echo "Running tests...\n\n";
    }

    public static function pass()
    {
        self::$passed++;
        echo '.';
    }

    public static function fail($expected, $actual, $message='')
    {
        self::$failed++;
        self::$failures[] = [
            'test' => self::$testName,
            'expected' => $expected,
            'actual' => $actual,
            'message' => $message
        ];
        echo 'f';
    }

    public static function failures()
    {
        foreach (self::$failures as $failure) {
            printf(
                "\n\nFAILURE: %s\nexpected: \"%s\"\nactual: \"%s\"",
                $failure['test'],
                $failure['expected'],
                $failure['actual']
            );
            if ($failure['message']) {
                echo "\nmessage: \"{$failure['message']}\"";
            }
        }
    }

    public static function footer()
    {
        $total = self::$passed + self::$failed;
        $passed = self::$passed;
        $failed = self::$failed;
        echo "\n\n$total tests run (p:$passed/f:$failed)\n";
    }

    public static function reset()
    {
        self::$passed = 0;
        self::$failed = 0;
        self::$failures = [];
        self::$testName = '';
    }
}