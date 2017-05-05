<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class AddTest extends TestCase
{
    use RunnerTrait;

    public function testAddition()
    {
        $this->assertEquals(5, $this->valueOf('(+ 1 4)'));
    }
}
