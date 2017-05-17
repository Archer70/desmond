<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\StringType;

class StringTest extends TestCase
{
    public function setUp()
    {
        $this->string = new StringType("Heyo");
    }

    public function testValue()
    {
        $this->assertEquals('Heyo', $this->string->value());
    }

    public function testToString()
    {
        $this->assertEquals('Heyo', $this->string->__toString());
    }

    public function testRemovesSurroundingQuotes()
    {
        $string = new StringType('"test"');
        $this->assertEquals('test', $string->value());
    }

    public function testQuoteLiteral()
    {
        $string = new StringType('testing \" testing');
        $this->assertEquals('testing " testing', $string->value());
    }

    public function testNewLines()
    {
        $string = new StringType('new \n line');
        $this->assertEquals("new \n line", $string->value());
    }

    public function testDontFormat()
    {
        $string = new StringType('"quotes \n \" yeah"', true);
        $this->assertEquals('"quotes \n \" yeah"', $string->value());
    }
}
