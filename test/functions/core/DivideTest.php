<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DivideTest extends TestCase
{
    use RunnerTrait;

    public function testDivision()
    {
        $this->assertEquals(5, $this->valueOf('(/ 10 2)'));
    }

    public function testReturnsFirstDividendIfNoDivisor()
    {
        $this->assertEquals(5, $this->valueOf('(/ 5)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "/" expects argument 1 to be a Number.
     */
    public function testFailsIfNoDividend()
    {
        $this->resultOf('(/)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "/" expects divisors to be Numbers.
     */
    public function testFailsIfYoureAnIdiot()
    {
        $this->resultOf('(/ 10 "five")');
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('2'), $this->valueOf('
            (do
                (define two 2)
                (/ two 1)
                two
            )
        '));
    }
}
