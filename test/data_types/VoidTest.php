<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\VoidType;

class VoidTest extends TestCase
{
    public function setUp()
    {
        $this->void = new VoidType();
    }
    
    public function testToString()
    {
        $this->assertEquals('', $this->void->__toString());
    }

    public function testValue()
    {
        $this->assertNull($this->void->value());
    }
}
