<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test_framework\TestRunner;

class ChangeTestReporterTest extends TestCase
{
    use RunnerTrait;

    public function testChangeReporter()
    {
        TestRunner::resetReporterToDefault();

        $this->assertEquals(
            'Desmond\\test_framework\\reporters\\Dotty',
            TestRunner::reporter()
        );

        $this->assertTrue(
            $this->valueOf('(change-test-reporter "void")')
        );

        $this->assertFalse(
            $this->valueOf('(change-test-reporter "notreal")')
        );
    }
}
