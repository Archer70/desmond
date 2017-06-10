<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class SubtractTest extends TestCase
{
    use RunnerTrait;

    public function testSubtraction()
    {
        $this->assertEquals(-3, $this->valueOf('(- 1 4)'));
    }

    public function testNoArgs()
    {
        $this->assertEquals(0, $this->valueOf('(-)'));
    }

    public function testOneArg()
    {
        $this->assertEquals(-3, $this->valueOf('(- 3)'));
    }

    public function testFloat()
    {
        $this->assertEquals(4.20, $this->valueOf('(- 5 0.80)'));
    }

    public function testNegativeFloat()
    {
        $this->assertEquals(-4.20, $this->valueOf('(- 1 5.20)'));
        $this->assertEquals(-4.20, $this->valueOf('(- 4.20)'));
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('2'), $this->valueOf('
            (do
                (define two 2)
                (- two 1)
                two
            )
        '));
    }
}
