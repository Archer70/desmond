<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\TrueType;

class TrueTest extends TestCase
{
    public function setUp()
    {
        $this->true = new TrueType();
    }

    public function testValue()
    {
        $this->assertEquals(true, $this->true->value());
    }

    public function testToString()
    {
        $this->assertEquals('true', $this->true->__toString());
    }
}
