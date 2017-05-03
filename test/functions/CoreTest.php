<?php
use PHPUnit\Framework\TestCase;
use Desmond\Lexer;
use Desmond\Evaluator;
use Desmond\functions\Core;
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
        $ast = Core::ast([new StringType("(+ 1 2)")]);
        $this->assertInstanceOf('Desmond\\data_types\\ListType', $ast);
        $this->assertEquals('+', $ast->get(0)->value());

        $ast = Core::ast([new StringType("/")]);
        $this->assertEquals('/', $ast->value());
    }

    public function testEquals()
    {
        $equalArgs = [new IntegerType(7), new IntegerType(7), new IntegerType(7)];
        $unequalArgs = [new IntegerType(7), new IntegerType(7), new IntegerType(5)];
        $this->assertEquals(true, Core::equal($equalArgs)->value());
        $this->assertEquals(false, Core::equal($unequalArgs)->value());
    }

    public function testPrint()
    {
        $this->expectOutputString('test words');
        Core::outputPrint([new StringType('test'), new StringType(' words')]);
    }

    public function testPrintLine()
    {
        $this->expectOutputString("test words\n");
        Core::outputPrintLine([new StringType('test'), new StringType(' words')]);
    }
}
