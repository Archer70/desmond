<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\NumberType;

class NumberTest extends TestCase
{
    public function testValue()
    {
        $int = new NumberType(7);
        $this->assertEquals(7, $int->value());

        $float = new NumberType(4.20);
        $this->assertEquals(4.20, $float->value());
    }

    public function testToString()
    {
        $float = new NumberType(4.20);
        $this->assertEquals('4.20', $float->__toString());
    }
}
