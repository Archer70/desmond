<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\ListType;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class ConsTest extends TestCase
{
    use RunnerTrait;
    use NumberTrait;

    public function testConsAddOne()
    {
        $this->assertEquals(
            $this->intList([1]), $this->valueOf('(cons 1 (list))'));
    }

    public function testConsAddOneToListWithElement()
    {
        $this->assertEquals(
            $this->intList([1, 2]), $this->valueOf('(cons 1 (list 2))'));
    }

    public function testConsAddToListWithMultiple()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]), $this->valueOf('(cons 1 (list 2 3))'));
    }

    public function testConsTwoLists()
    {
        $one = $this->intType(1);
        $two = $this->intType(2);
        $three = $this->intType(3);

        $this->assertEquals(
            [new ListType([$one]), $two, $three],
            $this->valueOf('(cons (list 1) (list 2 3))'));
    }

    public function testConsSymbols()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]),
            $this->valueOf('(do (define a (list 2 3)) (cons 1 a))'));
    }

    public function testConsVector()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]),
            $this->valueOf('(cons 1 [2 3])')
        );
    }

    public function testReturnsTheRightCollction()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\VectorType',
            $this->resultOf('(cons 1 [2 3])')
        );

        $this->assertInstanceOf(
            'Desmond\\data_types\\ListType',
            $this->resultOf('(cons 1 (list 2 3))')
        );
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "cons" expects 2 arguments.
     */
    public function testFailsIfNoFirstArgument()
    {
        $this->resultOf('(cons)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "cons" expects argument 2 to be one of [List, Vector].
     */
    public function testFailsIfSecondArgIsNotListOrVector()
    {
        $this->resultOf('(cons 1 "string")');
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('(list 2 3)'), $this->valueOf('
            (do
                (define lst (list 2 3))
                (cons 1 lst)
                lst
            )
        '));
    }
}
