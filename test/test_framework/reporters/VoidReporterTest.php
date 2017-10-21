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

    public function testId()
    {
        $this->assertEquals('void', $this->reporter->id());
    }

    public function testPass()
    {
        $this->assertNull($this->reporter->pass('testName'));
    }

    public function testFail()
    {
        $this->assertNull($this->reporter->fail('testName', 'expected', 'actual'));
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