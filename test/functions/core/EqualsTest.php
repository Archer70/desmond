<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EqualsTest extends TestCase
{
    use RunnerTrait;

    public function testEquals()
    {
        $this->assertTrue($this->valueOf('(= 1 1 1 1)'));
        $this->assertFalse($this->valueOf('(= 1 2)'));
    }
}
