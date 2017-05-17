<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EqualTest extends TestCase
{
    use RunnerTrait;

    public function testEquals()
    {
        $this->assertTrue($this->valueOf('(= 1 1 1 1)'));
        $this->assertFalse($this->valueOf('(= 1 2)'));
    }

    public function testEqualsArray()
    {
        $this->assertTrue($this->valueOf('(= [1 2] [1 2])'));
        $this->assertFalse($this->valueOf('(= [1 2] [3 4])'));
    }

    public function testNoArguments()
    {
        $this->assertTrue($this->valueOf('(=)'));
    }

    public function testOneArgument()
    {
        $this->assertTrue($this->valueOf('(= 1)'));
    }
}
