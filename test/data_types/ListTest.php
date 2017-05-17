<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\ListType;

class ListTest extends TestCase
{
    public function setUp()
    {
        $this->list = new ListType([1, 2, 3]);
    }

    public function testValue()
    {
        $this->assertEquals([1, 2, 3], $this->list->value());
    }

    public function testToString()
    {
        $this->assertEquals('(1, 2, 3)', $this->list->__toString());
    }

    public function testGetFunction()
    {
        $this->assertEquals(1, $this->list->getFunction());
    }

    public function testGetArgs()
    {
        $this->assertEquals([2, 3], $this->list->getArgs());
    }
}
