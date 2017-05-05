<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\data_types\IntegerType;
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
        $one = new IntegerType(1);
        $two = new IntegerType(2);
        $three = new IntegerType(3);

        $this->assertEquals([$one, $two, $three], $this->valueOf('(quote (1 2 3))'));
    }

    public function testQuoteRecursiveLists()
    {
        $one = new IntegerType(1);
        $two = new IntegerType(2);
        $three = new IntegerType(3);
        $four = new IntegerType(4);

        $this->assertEquals([$one, $two, new ListType([$three, $four])], $this->valueOf('(quote (1 2 (3 4)))'));
    }
}
