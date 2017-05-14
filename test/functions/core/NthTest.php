<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class NthTest extends TestCase
{
    use RunnerTrait;

    public function testNumericIndexOfVector()
    {
        $this->assertEquals(3, $this->valueOf('(nth [1 2 3 4] 2)'));
    }

    public function testNumericIndexOfList()
    {
        $this->assertEquals(3, $this->valueOf('(nth (list 1 2 3 4) 2)'));
    }

    public function testReturnsNilIfNotFound()
    {
        $this->assertEquals(null, $this->valueOf('(nth [] 1)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Nth expects first argument to be a List or Vector.
     */
    public function testFailsIfNoFirstArgument()
    {
        $this->resultOf('(nth)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Nth expects first argument to be a List or Vector.
     */
    public function testFailsIfNotListOrVector()
    {
        $this->resultOf('(nth "string" 2)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Nth expects second argument to be a Number.
     */
    public function testFailsIfNoSecondArgument()
    {
        $this->resultOf('(nth [1 2 3])');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Nth expects second argument to be a Number.
     */
    public function testFailsIfSecondArgumentNotNumber()
    {
        $this->resultOf('(nth [1 2 3] "index")');
    }
}
