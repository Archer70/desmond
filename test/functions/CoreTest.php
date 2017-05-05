<?php
use PHPUnit\Framework\TestCase;
use Desmond\Lexer;
use Desmond\Evaluator;
use Desmond\data_types\ListType;
use Desmond\data_types\IntegerType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\StringType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;
use Desmond\data_types\NilType;


class CoreTest extends TestCase
{
    use Desmond\test\helpers\RunnerTrait;

    public function testAst()
    {
        $ast = $this->resultOf('(ast "(+ 1 2 3)")');
        $this->assertEquals('+', $ast->get(0)->value());
        $this->assertEquals('/', $this->valueOf('(ast "/")'));
    }

    public function testEquals()
    {
        $this->assertTrue($this->valueOf('(= 1 1 1 1)'));
        $this->assertFalse($this->valueOf('(= 1 2)'));
    }

    public function testPrint()
    {
        $this->expectOutputString('test words');
        $this->resultOf('(print "test words")');
    }

    public function testPrintLine()
    {
        $this->expectOutputString("test words\n");
        $this->resultOf('(print-line "test words")');
    }
}
