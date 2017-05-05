<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class IfTest extends TestCase
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
}
