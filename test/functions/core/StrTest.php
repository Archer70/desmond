<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class StrTest extends TestCase
{
    use RunnerTrait;

    public function testStr()
    {
        $this->assertEquals(
            'test string', $this->valueOf('(str "test ", "string")'));
    }

    public function testNumbers()
    {
        $this->assertEquals(
            '12345', $this->valueOf('(str 1 2 3 4 5)'));
    }

    public function testVector()
    {
        $this->assertEquals('[1, 2, 3]', $this->valueOf('(str [1 2 3])'));
    }
}
