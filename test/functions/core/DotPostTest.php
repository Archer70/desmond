<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotPostTest extends TestCase
{
    use RunnerTrait;

    public function setUp()
    {
        $_POST['dotpost'] = 'test';
    }

    public function testdotpost()
    {
        $this->assertEquals('test', $this->valueOf('(.post "dotpost")'));
    }

    public function testNoArgument()
    {
        $this->assertEquals(['dotpost' => 'test'], $this->valueOf('(.post)'));
    }

    public function testSymbolIndex()
    {
        $this->assertEquals('test', $this->valueOf('(let {index "dotpost"} (.post index))'));
    }

    public function testNumber()
    {
        $_POST['num'] = 1;
        $this->assertSame(1, $this->valueOf('(.post "num")'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Index "not-found" not found.
     */
    public function testIndexNotFound()
    {
        $this->resultOf('(.post not-found)');
    }
}
