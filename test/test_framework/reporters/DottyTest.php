<?php
namespace Desmond\test\test_framework\reporters;
use Desmond\test_framework\reporters\Dotty;
use PHPUnit\Framework\TestCase;

class DottyTest extends TestCase
{
    private $dotty;

    public function setUp()
    {
        $this->dotty = new Dotty();
    }

    public function testId()
    {
        $this->assertEquals('dotty', $this->dotty->id());
    }

    public function testPass()
    {
        $this->expectOutputString('.');
        $this->dotty->pass('testName');
    }

    public function testFail()
    {
        $this->expectOutputString('

FAILURE: testName
expected: 1
actual: 2');
        $this->dotty->fail('testName', 1, 2);
    }

    public function testFailWithMessage()
    {
        $this->expectOutputString('

FAILURE: testName
expected: 1
actual: 2
message: "Some dumb thing."');
        $this->dotty->fail('testName', 1, 2, 'Some dumb thing.');
    }

    public function testHeader()
    {
        $this->expectOutputString("Running tests...\n");
        $this->dotty->header();
    }

    public function testFooter()
    {
        $this->expectOutputString("0 tests run.\n");
        $this->dotty->footer();
    }
}