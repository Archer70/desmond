<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class SetTest extends TestCase
{
    use RunnerTrait;

    public function testGetFromHash()
    {
        $this->assertEquals('val', $this->valueOf('
            (let
                {:test-map (set {} :key2 "val")}
                (get :test-map :key2)
            )'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoHash()
    {
        $this->resultOf('(set)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoKey()
    {
        $this->resultOf('(set {})');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoValue()
    {
        $this->resultOf('(set {} :key)');
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('{:key "val"}'), $this->valueOf('
            (do
                (define my-hash {:key "val"})
                (set my-hash :new-key "new value")
                my-hash
            )
        '));
    }
}
