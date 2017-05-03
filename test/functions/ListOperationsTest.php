<?php
use PHPUnit\Framework\TestCase;
use Desmond\data_types\ListType;

class ListOperationsTest extends TestCase
{
    use Desmond\test\helpers\RunnerTrait;
    use Desmond\test\helpers\NumberTrait;

    public function testList()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\ListType', $this->resultOf('(list (+ 1 2))'));
    }

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

    public function testConcatNothing()
    {
        $this->assertEquals([], $this->valueOf('(concat)'));
    }

    public function testConcatOneList()
    {
        $this->assertEquals(
            $this->intList([1, 2]), $this->valueOf('(concat (list 1 2))'));
    }

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

    public function testConcatAnEmptyConcat()
    {
        $this->assertEquals([], $this->valueOf('(concat (concat))'));
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
}
