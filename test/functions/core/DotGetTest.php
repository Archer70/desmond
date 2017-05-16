<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotGetTest extends TestCase
{
    use RunnerTrait;

    public function setUp()
    {
        $_GET['dotget'] = 'test';
    }

    public function testDotGet()
    {
        $this->assertEquals('test', $this->valueOf('(.get "dotget")'));
    }

    public function testNoArgument()
    {
        $this->assertEquals(['dotget' => 'test'], $this->valueOf('(.get)'));
    }

    public function testSymbolIndex()
    {
        $this->assertEquals('test', $this->valueOf('(let {index "dotget"} (.get index))'));
    }

    public function testNumber()
    {
        $_GET['num'] = 1;
        $this->assertSame(1, $this->valueOf('(.get "num")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage ".get": Index "not-found" not found.
     */
    public function testIndexNotFound()
    {
        $this->resultOf('(.get not-found)');
    }
}
