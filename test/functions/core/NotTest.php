<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class NotTest extends TestCase
{
    use RunnerTrait;

    public function testNotEqual()
    {
        $this->assertTrue($this->valueOf('(not (= 1 2))'));
    }

    public function testIsEqual()
    {
        $this->assertFalse($this->valueOf('(not (= 1 1))'));
    }

    public function testNoArgument()
    {
        $this->assertTrue($this->valueOf('(not)'));
    }
}
