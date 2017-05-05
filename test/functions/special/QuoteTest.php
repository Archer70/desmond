<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\data_types\NumberType;
use Desmond\data_types\ListType;

class QuoteTest extends TestCase
{
    use RunnerTrait;

    public function testQuoteInt()
    {
        $this->assertEquals(7, $this->valueOf('(quote 7)'));
    }

    public function testQuoteList()
    {
        $one = new NumberType(1);
        $two = new NumberType(2);
        $three = new NumberType(3);

        $this->assertEquals([$one, $two, $three], $this->valueOf('(quote (1 2 3))'));
    }

    public function testQuoteRecursiveLists()
    {
        $one = new NumberType(1);
        $two = new NumberType(2);
        $three = new NumberType(3);
        $four = new NumberType(4);

        $this->assertEquals([$one, $two, new ListType([$three, $four])], $this->valueOf('(quote (1 2 (3 4)))'));
    }
}
