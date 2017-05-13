<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotMethodTest extends TestCase
{
    use RunnerTrait;

    public function testCallsInstanceMethod()
    {
        $this->assertEquals(7,
            $this->valueOf('(.method (.new Desmond\\test\\mocks\\DotMethodMock) returnSeven)'));
    }

    public function testDefinedObject()
    {
        $this->assertEquals(7, $this->valueOf('
            (do
                (define mock (.new Desmond\\test\\mocks\\DotMethodMock))
                (.method mock returnSeven)
            )'));
    }

    public function testCallsStaticMethod()
    {
        $this->assertEquals(7, $this->valueOf('
            (.method Desmond\\test\\mocks\\DotMethodMock::returnSevenStatic)'));
    }

    public function testCallsStaticMethodWithArgs()
    {
        $this->assertEquals(15, $this->valueOf('
            (.method Desmond\\test\\mocks\\DotMethodMock::addStatic 5 5 5)'));
    }

    public function testTakesArgumentsLikeABoss()
    {
        $this->assertEquals(15, $this->valueOf('
            (do
                (define mock (.new Desmond\\test\\mocks\\DotMethodMock))
                (.method mock add 5 5 5)
            )'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage First argument must be an object or Class::method.
     */
    public function testErrorIfNoObject()
    {
        $this->resultOf('(.method)');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage First argument must be an object or Class::method.
     */
    public function testErrorIfNotObject()
    {
        $this->resultOf('(.method 1)');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Method not found in object.
     */
    public function testErrorIfNoObjectMethod()
    {
        $this->resultOf('
            (do
                (define object (.new Desmond\\test\\mocks\\DotMethodMock))
                (.method object))');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Method not found in object.
     */
    public function testErrorIfUndefinedObjectMethod()
    {
        $this->resultOf('
            (do
                (define object (.new Desmond\\test\\mocks\\DotMethodMock))
                (.method object fakeMethod))');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage First argument must be an object or Class::method.
     */
    public function testErrorIfClassButNoMethod()
    {
        $this->resultOf('(.method NotRealClass)');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage First argument must be an object or Class::method.
     */
    public function testErrorIfNoClassExists()
    {
        $this->resultOf('(.method NotRealClass::method)');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Method "fakeMethod" not found in class "Desmond\test\mocks\DotMethodMock".
     */
    public function testErrorIfNoClassMethod()
    {
        $this->resultOf('(.method Desmond\\test\\mocks\\DotMethodMock::fakeMethod)');
    }
}

namespace Desmond\test\mocks;

class DotMethodMock
{
    public function returnSeven()
    {
        return 7;
    }

    public static function returnSevenStatic()
    {
        return 7;
    }

    public function add($int, $int2, $int3)
    {
        return $int + $int2 + $int3;
    }

    public static function addStatic($int, $int2, $int3)
    {
        return $int + $int2 + $int3;
    }
}
