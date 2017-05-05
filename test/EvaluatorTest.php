<?php
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EvaluatorTest extends TestCase
{
    use RunnerTrait;

    public function testReturnsAtom()
    {
        $this->assertEquals(5, $this->valueOf('5'));
    }

    public function testReturnsFunctionValue()
    {
        $this->assertEquals(5, $this->valueOf('(+ 2 3)'));
    }
}
