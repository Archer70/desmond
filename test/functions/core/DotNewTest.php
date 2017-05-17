<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotNewTest extends TestCase
{
    use RunnerTrait;

    public function testCreatesNewObjectType()
    {
        $this->assertInstanceOf('Desmond\\data_types\\ObjectType',
            $this->resultOf('(.new stdClass)'));
    }

    public function testTakesConstructorArguments()
    {
        $object = $this->valueOf('(.new Desmond\\data_types\\NumberType 1)');
        $this->assertInstanceOf('Desmond\\data_types\\NumberType', $object);
    }

    public function testEmptyClassNameReturnsStdClass()
    {
        $object = $this->valueOf('(.new)');
        $this->assertInstanceOf('stdClass', $object);
    }

    /**
    * @expectedException Desmond\exceptions\ArgumentException
    * @expectedExceptionMessage ".new" expects argument 1 to be one of [Symbol, String].
    */
    public function testFailsIfNotValidName()
    {
        $this->resultOf('(.new [])');
    }

    /**
    * @expectedException Desmond\exceptions\ArgumentException
    * @expectedExceptionMessage ".new": Class "FakeClass" not found.
    */
    public function testClassNotFound()
    {
        $this->resultOf('(.new FakeClass)');
    }
}
