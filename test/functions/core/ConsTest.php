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
}
