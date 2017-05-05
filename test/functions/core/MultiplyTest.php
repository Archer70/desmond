<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class MultiplyTest extends TestCase
{
    use RunnerTrait;

    public function testMultiplication()
    {
        $this->assertEquals(8, $this->valueOf('(* 2 4)'));
    }
}
