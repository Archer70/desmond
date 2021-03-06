<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class ConcatTest extends TestCase
{
    use RunnerTrait, NumberTrait;

    public function testConcatTwoLists()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3, 4]),
            $this->valueOf('(concat (list 1 2) (list 3 4))'));
    }

    public function testConcatUndetermindedNumberOfLists()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3, 4, 5, 6]),
            $this->valueOf('(concat (list 1 2) (list 3 4) (list 5 6))'));
    }

    public function testConcatMultipleDefinedLists()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3, 4, 5, 6]),
            $this->valueOf('
                (do
                    (define list1 (list 1 2))
                    (define list2 (list 3 4))
                    (concat list1 list2 (list 5 6)))'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "concat" expects argument 1 to be a List.
     */
    public function testConcatNothing()
    {
        $this->assertEquals([], $this->valueOf('(concat)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "concat" expects argument 2 to be a List.
     */
    public function testConcatOneList()
    {
        $this->assertEquals(
            $this->intList([1, 2]), $this->valueOf('(concat (list 1 2))'));
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('(list 1 2)'), $this->valueOf('
            (do
                (define lst (list 1 2))
                (concat lst (list 3 4))
                lst
            )
        '));
    }
}
