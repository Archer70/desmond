<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class AssertTrueTest extends TestCase
{
    use RunnerTrait;

    public function testAssertTrue()
    {
        $this->assertTrue($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-true true))'));

        $this->assertTrue($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-true 1))'));

        $this->assertTrue($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-true "string"))'));
    }

    public function testAssertNotTrue()
    {
        $this->assertFalse($this->valueOf('
            (do 
                (change-test-reporter "void")
                (assert-true false))'));
    }

    /**
     * @expectedException \Desmond\exceptions\ArgumentException
     */
    public function testArgumentFailure()
    {
        $this->resultOf('(assert-true)');
    }
}
