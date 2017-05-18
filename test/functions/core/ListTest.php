<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\NumberType;
use Desmond\test\helpers\RunnerTrait;

class ListTest extends TestCase
{
    use RunnerTrait;

    public function testList()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\ListType', $this->resultOf('(list (+ 1 2))'));
    }

    public function testHasContents()
    {
        $this->assertEquals(
            [new NumberType(1), new NumberType(2)],
            $this->valueOf('(list 1 2)'));
    }

    public function testEmptyList()
    {
        $this->assertEquals([], $this->valueOf('(list)'));
    }

    public function testFunction()
    {
        $func = $this->resultOf('(list + 1 2)')->get(0);
        $this->assertInstanceOf('Desmond\\functions\\DesmondFunction', $func);
    }
}
