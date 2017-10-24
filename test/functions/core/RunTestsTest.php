<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test_framework\TestRunner;

class RunTestsTest extends TestCase
{
    use RunnerTrait;

    public function testRunTests()
    {
        TestRunner::resetReporterToDefault();

        $this->expectOutputRegex('/\.\.f/');
        $path = __DIR__ . '/../../mocks/runtest_files';
        $this->resultOf('(run-tests "' . $path . '")');
    }
}
