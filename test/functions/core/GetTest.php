<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class GetTest extends TestCase
{
    use RunnerTrait;

    public function testGetFromHash()
    {
        $this->assertEquals(7, $this->valueOf('
            (get {:key 7} :key))'));
    }

    // You'd be better of using nth for this, but whatever.
    public function testGetFromVector()
    {
        $this->assertEquals(7, $this->valueOf('
            (get [1 3 5 7] 3)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Get expects first argument to be a collection.
     */
    public function testFailsIfNoHash()
    {
        $this->resultOf('(get)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Get expects first argument to be a collection.
     */
    public function testFailsIfNotAHash()
    {
        $this->resultOf('(get "string")');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Get expects second argument to be a Number, Symbol or String.
     */
    public function testFailsIfNoKey()
    {
        $this->resultOf('(get {:key "val"})');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage Get expects second argument to be a Number, Symbol or String.
     */
    public function testFailsIfNotValidKey()
    {
        $this->resultOf('(get {:key "val"} true)');
    }
}
