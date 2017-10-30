<?php
namespace Desmond\test\test_framework\reporters;
use Desmond\test_framework\reporters\Dotty;
use PHPUnit\Framework\TestCase;

class DottyTest extends TestCase
{
    public function testId()
    {
        $this->assertEquals('dotty', Dotty::id());
    }

    public function testPass()
    {
        $this->expectOutputString('.');
        Dotty::pass();
    }

    public function testFail()
    {
        $this->expectOutputString('f');
        Dotty::fail(1, 2);
    }

    public function testFailWithMessage()
    {
        $this->expectOutputString('f');
        Dotty::fail(1, 2, 'Some dumb thing.');
    }

    public function testHeader()
    {
        $this->expectOutputString("Running tests...\n\n");
        Dotty::header();
    }

    public function testFailures()
    {
        $this->expectOutputString('.ff

FAILURE: first-test
expected: "1"
actual: "2"
message: "message"

FAILURE: second-test
expected: "string"
actual: "text"
message: "message"');
        Dotty::reset();
        Dotty::pass();
        Dotty::setTestName('first-test');
        Dotty::fail(1, 2, 'message');
        Dotty::setTestName('second-test');
        Dotty::fail('string', 'text', 'message');
        Dotty::failures();
    }

    public function testFooter()
    {
        $this->expectOutputRegex('/\d tests run \(p:\d\/f:\d\)/');
        Dotty::footer();
    }
}