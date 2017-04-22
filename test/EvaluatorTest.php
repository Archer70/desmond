<?php
use PHPUnit\Framework\TestCase;
use Desmond\Lexer;
use Desmond\Evaluator;

class EvaluatorTest extends TestCase
{
    private $lexer;
    private $eval;

    public function setUp()
    {
        $this->lexer = new Lexer();
        $this->eval = new Evaluator();
    }

    public function testGetReturnValueOfInt()
    {
        $ast = $this->lexer->readString('5');
        $this->assertEquals(5, $this->eval->getReturn($ast)->value());
    }

    public function testEvaluatesAdditionForm()
    {
        $ast = $this->lexer->readString('(+ 2 3)');
        $this->assertEquals(5, $this->eval->getReturn($ast)->value());
    }

    public function testEvaluatesSubtractionForm()
    {
        $ast = $this->lexer->readString('(- 6 2)');
        $this->assertEquals(4, $this->eval->getReturn($ast)->value());
    }

    public function testMultiplication()
    {
        $ast = $this->lexer->readString('(* 2 2 2)');
        $this->assertEquals(8, $this->eval->getReturn($ast)->value());
    }

    public function testDivision()
    {
        $ast = $this->lexer->readString('(/ 6 2)');
        $this->assertEquals(3, $this->eval->getReturn($ast)->value());
    }

    public function testPrint()
    {
        $this->expectOutputString('My test string.');
        $ast = $this->lexer->readString('(print "My test string.")');
        $this->eval->getReturn($ast);
    }

    public function testNestedForms()
    {
        $ast = $this->lexer->readString('(+ 1 2 (+ 3 4))'); // (+ 3 7)
        $this->assertEquals(10, $this->eval->getReturn($ast)->value());

        $ast = $this->lexer->readString('(+ 1 2 (+ 3 4) (- 6 2))'); // (+ 3 7 4)
        $this->assertEquals(14, $this->eval->getReturn($ast)->value());
    }
}
