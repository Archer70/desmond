<?php
namespace Desmond\test_framework;
use Desmond\Desmond;

class TestRunner
{
    private $desmond;

    /**
     * @var \Desmond\test_framework\reporters\BaseReporter $reporter
     */
    private static $reporter;

    public function __construct()
    {
        $this->desmond = new Desmond();
        self::resetReporterToDefault();
    }

    public function runTests($testDir)
    {
        $reporter = self::reporter();
        $reporter::reset();
        $reporter::header();
        $this->executeFiles($testDir);
        $reporter::failures();
        $reporter::footer();
    }

    private function executeFiles($testDir)
    {
        if (!is_dir($testDir)) {
            printf('Directory not found: "%s"', $testDir);
            return;
        }
        $files = scandir($testDir);
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $path = $testDir . '/' . $file;
            if (is_dir($path)) {
                $this->executeFiles($path);
                continue;
            }
            if (!preg_match('/test\.dsmnd$/', $file)) {
                continue;
            }
            $this->desmond->loadFile($path);
        }
    }

    public static function reporters()
    {
        return json_decode(file_get_contents(
            __DIR__ . '/reporters.json'), true);
    }

    public static function reporter()
    {
        $defaultReporter = self::reporters()['dotty'];
        return self::$reporter ? self::$reporter : $defaultReporter;
    }

    public static function changeReporter($reporter)
    {
        $validList = self::reporters();
        if (array_key_exists($reporter, $validList)) {
            $class = $validList[$reporter];
            self::$reporter = $class;
            return true;
        }
        return false;
    }

    public static function resetReporterToDefault()
    {
        $class = self::reporters()['dotty'];
        self::$reporter = $class;
    }
}