<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EqualsQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testEquals()
    {
        $this->assertTrue($this->valueOf('(equal? 1 1 1 1)'));
        $this->assertFalse($this->valueOf('(equal? 1 2)'));
    }
}
