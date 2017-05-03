<?php
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    use Desmond\test\helpers\RunnerTrait;

    public function testAddition()
    {
        $this->assertEquals(5, $this->valueOf('(+ 1 4)'));
    }

    public function testSubtraction()
    {
        $this->assertEquals(-3, $this->valueOf('(- 1 4)'));
    }

    public function testMultiplication()
    {
        $this->assertEquals(8, $this->valueOf('(* 2 4)'));
    }

    public function testDivision()
    {
        $this->assertEquals(5, $this->valueOf('(/ 10 2)'));
    }
}
