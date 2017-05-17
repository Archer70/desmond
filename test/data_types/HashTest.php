<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\HashType;

class HashTest extends TestCase
{
    public function setUp()
    {
        $this->hash = new HashType(['key' => 'val', 'key2' => 'val2']);
    }

    public function testValue()
    {
        $this->assertEquals(['key' => 'val', 'key2' => 'val2'], $this->hash->value());
    }

    public function testToString()
    {
        $this->assertEquals('{key val, key2 val2}', $this->hash->__toString());
    }
}
