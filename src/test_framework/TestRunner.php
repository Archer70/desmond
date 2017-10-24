<?php
namespace Desmond\test_framework;
use Desmond\Desmond;

class TestRunner
{
    private $desmond;
    private static $reporter;

    public function __construct()
    {
        $this->desmond = new Desmond();
        self::resetReporterToDefault();
    }

    public function runTests($testDir)
    {
        self::reporter()->reset();
        self::reporter()->header();
        $this->executeFiles($testDir);
        self::reporter()->failures();
        self::reporter()->footer();
    }

    private function executeFiles($testDir)
    {
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
        return self::$reporter ? self::$reporter : new $defaultReporter;
    }

    public static function changeReporter($reporter)
    {
        $validList = self::reporters();
        if (array_key_exists($reporter, $validList)) {
            $class = $validList[$reporter];
            self::$reporter = new $class;
            return true;
        }
        return false;
    }

    public static function resetReporterToDefault()
    {
        $class = self::reporters()['dotty'];
        self::$reporter = new $class;
    }
}