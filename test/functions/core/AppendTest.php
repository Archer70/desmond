<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class AppendTest extends TestCase
{
    use RunnerTrait;
    use NumberTrait;

    public function testAppending()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]), $this->valueOf('(append [1 2] 3)'));
    }

    public function testList()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]), $this->valueOf('(append (list 1 2) 3)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNotHash()
    {
        $this->resultOf('(append {} 3)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoItem()
    {
        $this->resultOf('(append [])');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoCollection()
    {
        $this->resultOf('(append)');
    }
}
