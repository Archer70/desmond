<?php
namespace test_framework;
use PHPUnit\Framework\TestCase;
use Desmond\test_framework\TestRunner;

class TestRunnerTest extends TestCase
{
    private $runner;

    public function setUp()
    {
        $this->runner = new TestRunner();
    }

    public function testLoadsTestFiles()
    {
        $this->expectOutputRegex('/file 1, file 2\./');
        $this->runner->runTests(
            __DIR__ . '/../mocks/test_file_reading');
    }

    public function testGetReporter()
    {
        $this->assertEquals(
            'Desmond\\test_framework\\reporters\\Dotty',
            TestRunner::reporter()
        );
    }

    public function testReporterList()
    {
        $this->assertNotEmpty(TestRunner::reporters());
        $this->assertArrayHasKey('void', TestRunner::reporters());
    }

    public function testChangeReporter()
    {
        $this->assertEquals(
            'Desmond\\test_framework\\reporters\\Dotty',
            TestRunner::reporter()
        );

        TestRunner::changeReporter('void');

        $this->assertEquals(
            'Desmond\\test_framework\\reporters\\VoidReporter',
            TestRunner::reporter()
        );
    }

    public function testChangeReporterReturns()
    {
        $this->assertTrue(TestRunner::changeReporter('void'));
        $this->assertFalse(TestRunner::changeReporter('notreal'));
    }

    public function testFileNotFound()
    {
        $this->expectOutputRegex('/Directory not found: "test\/dir"/');
        $this->runner->runTests('test/dir');
    }
}