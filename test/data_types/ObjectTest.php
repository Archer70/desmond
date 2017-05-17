<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\ObjectType;

class ObjectTest extends TestCase
{
    public function setUp()
    {
        $this->object = new ObjectType(new \stdClass);
    }

    public function testValue()
    {
        $this->assertInstanceOf('stdClass', $this->object->value());
    }

    public function testToString()
    {
        $this->assertEquals('#object stdClass', $this->object->__toString());
    }
}
