<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class FunctionListTest extends TestCase
{
    use RunnerTrait;

    public function testGetsFunctions()
    {
        $this->assertContains('+', $this->valueOf('(function-list)'));
    }
}
