<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class PrependTest extends TestCase
{
    use RunnerTrait;
    use NumberTrait;

    public function testPrepending()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]), $this->valueOf('(prepend [2 3] 1)'));
    }

    public function testList()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]), $this->valueOf('(prepend (list 2 3) 1)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNotHash()
    {
        $this->resultOf('(prepend {} 3)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoItem()
    {
        $this->resultOf('(prepend [])');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoCollection()
    {
        $this->resultOf('(prepend)');
    }
}
