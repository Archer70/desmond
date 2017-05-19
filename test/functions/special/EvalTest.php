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

    public function testEvaluatesSymbol()
    {
        $this->assertEquals(5,
            $this->valueOf('
                (do
                    (define :my-list (ast "(+ 4 1)"))
                    (eval :my-list))'));
    }

    public function testEvalsLiteralString()
    {
        $this->assertEquals('test', $this->valueOf('(eval "test")'));
    }

    public function testNilIfNoEval()
    {
        $this->assertEquals(null, $this->valueOf('(eval)'));
    }
}
