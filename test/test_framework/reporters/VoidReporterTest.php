<?php
namespace Desmond\test\test_framework\reporters;
use Desmond\test_framework\reporters\VoidReporter;
use PHPUnit\Framework\TestCase;

class VoidReporterTest extends TestCase
{
    private $reporter;

    public function setUp()
    {
        $this->reporter = new VoidReporter();
    }

    public function testReset()
    {
        $this->assertNull($this->reporter->reset());
    }

    public function testId()
    {
        $this->assertEquals('void', $this->reporter->id());
    }

    public function testSetTestName()
    {
        $this->assertNull($this->reporter->setTestName('test'));
    }

    public function testPass()
    {
        $this->assertNull($this->reporter->pass('testName'));
    }

    public function testFail()
    {
        $this->assertNull($this->reporter->fail('testName', 'expected', 'actual'));
    }

    public function testFailures()
    {
        $this->assertNull($this->reporter->failures());
    }

    public function testHeader()
    {
        $this->assertNull($this->reporter->header());
    }

    public function testFooter()
    {
        $this->assertNull($this->reporter->footer());
    }
}