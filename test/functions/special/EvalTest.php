<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EvalTest extends TestCase
{
    use RunnerTrait;

    public function testEval()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\SymbolType', $this->resultOf('(eval :sym)'));
        $this->assertEquals(3,
            $this->valueOf('(eval (ast "(+ 1 2)"))'));
    }
}
