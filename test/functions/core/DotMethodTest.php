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
        $this->assertEquals(15, $this->valueOf('
            (.method Desmond\\test\\mocks\\DotMethodMock::add 5 5 5)'));
    }

    public function testTakesArgumentsLikeABoss()
    {
        $this->assertEquals(15, $this->valueOf('
            (do
                (define mock (.new Desmond\\test\\mocks\\DotMethodMock))
                (.method mock add 5 5 5)
            )'));
    }
}

namespace Desmond\test\mocks;

class DotMethodMock
{
    public function returnSeven()
    {
        return 7;
    }

    public function add($int, $int2, $int3)
    {
        return $int + $int2 + $int3;
    }
}
