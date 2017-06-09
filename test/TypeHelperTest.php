<?php
namespace Desmond\test;
use Desmond\TypeHelper;
use PHPUnit\Framework\TestCase;

class TypeHelperTest extends TestCase
{
    use TypeHelper;
    use \Desmond\test\helpers\NumberTrait;

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

    public function testVectorContentsEncoded()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3], true),
            self::fromPhpType([1, 2, 3]));
    }

    public function testVectorContentsRecursivelyEncoded()
    {
        $expected = $this->intList([1, 2], true);
        $expected->set($this->intList([3, 4], true));
        $this->assertEquals(
            $expected,
            self::fromPhpType([1, 2, [3, 4]]));
    }

    public function testHashType()
    {
        $this->assertInstanceOf(self::type('HashType'), self::fromPhpType(['key' => 'val']));
    }

    public function testHashContentsEncoded()
    {
        $this->assertInstanceOf(
            self::type('StringType'), self::fromPhpType(['key', 'val'])->first());
    }

    public function testHashContentsRecursivelyEncoded()
    {
        $result = self::fromPhpType(['key' => ['sub-key' => 'val']])->get('key')->get('sub-key');
        $this->assertInstanceOf(
            self::type('StringType'), $result);
    }

    public function testObjectType()
    {
        $this->assertInstanceOf(self::type('ObjectType'), self::fromPhpType(new \stdClass));
    }

    public function testToPhpCollection()
    {
        $array = [1, 2, 3];
        $numbers = self::fromPhpType($array);
        $this->assertEquals($array, self::toPhpType($numbers));
    }

    public function testToPhpSingleType()
    {
        $this->assertEquals('string', self::fromPhpType('string'));
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Unknown PHP type.
    */
    public function testUnknownType()
    {
        self::fromPhpType(\STDIN);
    }

    private function type($type)
    {
        return "Desmond\\data_types\\$type";
    }
}
