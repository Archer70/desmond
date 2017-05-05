<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\data_types\IntegerType;
use Desmond\data_types\ListType;
use Desmond\data_types\NilType;

class QuasiquoteTest extends TestCase
{
    use RunnerTrait;

    public function testQuasiQuoteInt()
    {
        $this->assertEquals(7, $this->valueOf('(quasiquote 7)'));
    }

    public function testQuasiQuoteIntList()
    {
        $one = new IntegerType(1);
        $two = new IntegerType(2);
        $three = new IntegerType(3);

        $this->assertEquals([$one, $two, $three], $this->valueOf('(quasiquote (1 2 3))'));
    }

    public function testQuasiQuoteNestedIntLists()
    {
        $one = new IntegerType(1);
        $two = new IntegerType(2);
        $three = new IntegerType(3);
        $four = new IntegerType(4);
        $this->assertEquals(
            [$one, $two, new ListType([$three, $four])],
            $this->valueOf('(quasiquote (1 2 (3 4)))'));
    }

    public function testQuasiQuoteNilList()
    {
        $this->assertEquals(
            [new NilType()], $this->valueOf('(quasiquote (nil))'));
    }

    public function testQuasiQuoteSymbol()
    {
        $this->assertEquals('sym', $this->valueOf('
            (do
                (define sym 10)
                (quasiquote sym))'));
    }

    public function testUnquoteInt()
    {
        $this->assertEquals(7, $this->valueOf('(quasiquote (unquote 7))'));
    }

    public function testUnquoteSymbol()
    {
        $this->assertEquals(8, $this->valueOf('
            (do
                (define :num 8)
                (quasiquote (unquote :num)))'));
    }

    public function testUnquoteSymbolInList()
    {
        $one = new IntegerType(1);
        $two = new IntegerType(2);
        $three = new IntegerType(3);

        $this->assertEquals([$one, $two, $three], $this->valueOf('
            (do
                (define :two 2)
                (quasiquote (1 (unquote :two) 3))
            )'));
    }
}
