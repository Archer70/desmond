<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\NilType;

class NilTest extends TestCase
{
    public function setUp()
    {
        $this->nil = new NilType();
    }

    public function testValue()
    {
        $this->assertEquals(null, $this->nil->value());
    }

    public function testToString()
    {
        $this->assertEquals('nil', $this->nil->__toString());
    }
}
