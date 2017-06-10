<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\data_types\NumberType;
use Desmond\data_types\StringType;

class RestTest extends TestCase
{
    use RunnerTrait;

    public function testGetsRest()
    {
        $this->assertEquals(
            [new NumberType(6), new NumberType(7)],
            $this->valueOf('(rest [5 6 7])'));
    }

    public function testGetsRestOfMap()
    {
        $this->assertEquals(
            [new StringType('test2')],
            $this->valueOf('(rest {:key "test" :key2 "test2"})'));
    }

    public function testGetsRestOfList()
    {
        $this->assertEquals(
            [new StringType('second')],
            $this->valueOf('(rest (list "test" "second"))'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailesIfNoArgument()
    {
        $this->resultOf('(rest)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailesIfArgumentNotCollection()
    {
        $this->resultOf('(rest "string")');
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('[1 2 3]'), $this->valueOf('
            (do
                (define vec [1 2 3])
                (rest vec)
                vec
            )
        '));
    }
}
