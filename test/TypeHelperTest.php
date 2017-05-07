<?php
namespace Desmond\test;
use Desmond\TypeHelper;
use PHPUnit\Framework\TestCase;

class TypeHelperTest extends TestCase
{
    use TypeHelper;

    public function testNilType()
    {
        $this->assertInstanceOf(self::type('NilType'), self::fromPhpType(null));
    }

    public function testTrue()
    {
        $this->assertInstanceOf(self::type('TrueType'), self::fromPhpType(true));
    }

    public function testFalse()
    {
        $this->assertInstanceOf(self::type('FalseType'), self::fromPhpType(false));
    }

    public function testInt()
    {
        $this->assertInstanceOf(self::type('NumberType'), self::fromPhpType(7));
    }

    public function testFloat()
    {
        $this->assertInstanceOf(self::type('NumberType'), self::fromPhpType(4.20));
    }

    public function testString()
    {
        $this->assertInstanceOf(self::type('StringType'), self::fromPhpType("string"));
    }

    public function testVectorType()
    {
        $this->assertInstanceOf(self::type('VectorType'), self::fromPhpType([1, 2, 3]));
    }

    public function testHashType()
    {
        $this->assertInstanceOf(self::type('HashType'), self::fromPhpType(['key' => 'val']));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Unidentified PHP type.
     */
    public function testUnknownType()
    {
        self::fromPhpType(function () {});
    }

    private function type($type)
    {
        return "Desmond\\data_types\\$type";
    }
}
