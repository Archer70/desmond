<?php
namespace Desmond\test\functions\special;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ConditionalTest extends TestCase
{
    use RunnerTrait;

    public function testIf()
    {
        $this->assertEquals('yay', $this->valueOf('(if true "yay")'));
        $this->assertNull($this->valueOf('(if false "nope")'));
    }

    public function testIfElse()
    {
        $this->assertEquals(
            'nope', $this->valueOf('(if false "yep" "nope")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "if" expects first argument condition.
     */
    public function testNoCondition()
    {
        $this->resultOf('(if)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "if" expects second argument body.
     */
    public function testNoBody()
    {
        $this->resultOf('(if true )');
    }
}
