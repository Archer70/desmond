<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\VectorType;
use Desmond\data_types\NumberType;

class TestVector extends TestCase
{
    public function setUp()
    {
        $this->vector = new VectorType([
            new NumberType(1),
            new NumberType(2)
        ]);
    }

    public function testToString()
    {
        $this->assertEquals('[1, 2]', $this->vector->__toString());
    }

    public function testEnds()
    {
        $this->assertEquals(['[', ']'], $this->vector->ends());
    }

    public function testValue()
    {
        $vector = new VectorType([1, 2]);
        $this->assertEquals([1, 2], $vector->value());
    }
}
