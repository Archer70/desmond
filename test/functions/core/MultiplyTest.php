<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class MultiplyTest extends TestCase
{
    use RunnerTrait;

    public function testMultiplication()
    {
        $this->assertEquals(8, $this->valueOf('(* 2 4)'));
    }

    public function testNoNumbers()
    {
        $this->assertEquals(0, $this->valueOf('(*)'));
        $this->assertEquals(7, $this->valueOf('(* 7)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testInvalidType()
    {
        $this->resultOf('(* "seven")');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "*" expects all arguments to be Numbers.
     */
    public function testInvalidNumber()
    {
        $this->resultOf('(* 2 "five")');
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('2'), $this->valueOf('
            (do
                (define two 2)
                (* two 2)
                two
            )
        '));
    }
}
