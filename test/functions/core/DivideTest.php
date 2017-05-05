<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DivideTest extends TestCase
{
    use RunnerTrait;

    public function testDivision()
    {
        $this->assertEquals(5, $this->valueOf('(/ 10 2)'));
    }
}
