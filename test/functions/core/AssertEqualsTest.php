<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class AssertEqualsTest extends TestCase
{
    use RunnerTrait;

    public function testAssertEquals()
    {
        $this->assertTrue($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-equals 1 1))'));
    }

    public function testAssertEqualsFail()
    {
        $this->assertFalse($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-equals 1 2))'));
    }

    /**
     * @expectedException \Desmond\exceptions\ArgumentException
     */
    public function testArgumentFailure()
    {
        $this->resultOf('(assert-equals 1)');
    }
}
