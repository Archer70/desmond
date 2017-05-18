<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class FirstTest extends TestCase
{
    use RunnerTrait;

    public function testGetsFirst()
    {
        $this->assertEquals(5, $this->valueOf('(first [5 6 7])'));
    }

    public function testGetsFirstOfMap()
    {
        $this->assertEquals('test', $this->valueOf('(first {:key "test"})'));
    }

    public function testGetsFirstOfList()
    {
        $this->assertEquals('test', $this->valueOf('(first (list "test" "second"))'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailesIfNoArgument()
    {
        $this->resultOf('(first)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailesIfArgumentNotCollection()
    {
        $this->resultOf('(first "string")');
    }
}
