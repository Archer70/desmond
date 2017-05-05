<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class SubtractTest extends TestCase
{
    use RunnerTrait;

    public function testSubtraction()
    {
        $this->assertEquals(-3, $this->valueOf('(- 1 4)'));
    }
}
