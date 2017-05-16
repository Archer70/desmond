<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class AddTest extends TestCase
{
    use RunnerTrait;

    public function testAddition()
    {
        $this->assertEquals(5, $this->valueOf('(+ 1 4)'));
    }

    public function testAddFloats()
    {
        $this->assertEquals(6.0, $this->valueOf('(+ 4.20 1.80)'));
        $this->assertEquals(6.20, $this->valueOf('(+ 4.20 2)'));
    }

    public function testReturnsPositiveInt()
    {
        $this->assertEquals(7, $this->valueOf('(+ -7)'));
    }

    public function testReturnsPositiveFloat()
    {
        $this->assertEquals(7.10, $this->valueOf('(+ -7.10)'));
    }

    public function testReturnsZeroIfNoArgs()
    {
        $this->assertEquals(0, $this->valueOf('(+)'));
    }

    /**
    * @expectedException Desmond\exceptions\ArgumentException
    * @expectedExceptionMessage
    */
    public function testFailsIfArgsArentNumbers()
    {
        $this->resultOf('(+ "one")');
    }
}
