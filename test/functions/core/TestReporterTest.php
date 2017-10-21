<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test_framework\TestRunner;

class TestReporterTest extends TestCase
{
    use RunnerTrait;

    public function testGetReporter()
    {
        TestRunner::resetReporterToDefault();
        $this->assertEquals('dotty', $this->valueOf('(test-reporter)'));
    }
}
