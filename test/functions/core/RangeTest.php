<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class RangeTest extends TestCase
{
    use RunnerTrait;

    public function testRange()
    {
        $this->assertEquals([0, 1, 2, 3, 4, 5], $this->valueOf('(range 0 5)'));
    }

    public function testOneArgument()
    {
        $this->assertEquals([0, 1, 2, 3], $this->valueOf('(range 3)'));
    }

    public function testWithFloat()
    {
        $this->assertEquals([0, 1, 2], $this->valueOf('(range 2.40)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoArgs()
    {
        $this->resultOf('(range)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testWrongSecondArg()
    {
        $this->resultOf('(range 1 "number")');
    }
}
