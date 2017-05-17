<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\FalseType;

class FalseTest extends TestCase
{
    public function setUp()
    {
        $this->hash = new FalseType();
    }

    public function testValue()
    {
        $this->assertEquals(false, $this->hash->value());
    }

    public function testToString()
    {
        $this->assertEquals('false', $this->hash->__toString());
    }
}
