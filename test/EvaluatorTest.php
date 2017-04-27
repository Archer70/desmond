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

    public function testReturnsAtom()
    {
        $ast = $this->lexer->readString('5');
        $this->assertEquals(5, $this->eval->getReturn($ast)->value());
    }

    public function testNestedForms()
    {
        $ast = $this->lexer->readString('(+ 1 2 (+ 3 4))'); // (+ 3 7)
        $this->assertEquals(10, $this->eval->getReturn($ast)->value());

        $ast = $this->lexer->readString('(+ 1 2 (+ 3 4) (- 6 2))'); // (+ 3 7 4)
        $this->assertEquals(14, $this->eval->getReturn($ast)->value());
    }

    public function testVector()
    {
        $ast = $this->lexer->readString('[1 2]');
        $this->assertInstanceOf('Desmond\\data_types\\VectorType', $this->eval->getReturn($ast));
        $this->assertEquals(2, $this->eval->getReturn($ast)->get(1)->value());
    }

    public function testVectorEvaluatesSymbols()
    {
        $ast = $this->lexer->readString('[(+ 2 3)]');
        $vector = $this->eval->getReturn($ast);
        $this->assertEquals(5, $vector->get(0)->value());
    }

    public function testDefine()
    {
        $ast = $this->lexer->readString('(define my-sym "it worked")');
        $this->eval->getReturn($ast);
        $ast = $this->lexer->readString('my-sym');
        $this->assertEquals('it worked', $this->eval->getReturn($ast)->value());
    }
}
