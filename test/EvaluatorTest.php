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

    public function testVectorEvaluatesForms()
    {
        $ast = $this->lexer->readString('[(+ 2 3)]');
        $vector = $this->eval->getReturn($ast);
        $this->assertEquals(5, $vector->get(0)->value());
    }

    public function testHash()
    {
        $ast = $this->lexer->readString('{:key 1}');
        $hash = $this->eval->getReturn($ast);
        $this->assertInstanceOf('Desmond\\data_types\\HashType', $hash);
        $this->assertEquals(1, $hash->get(':key')->value());
    }

    public function testHashEvaluatesForms()
    {
        $ast = $this->lexer->readString('{:key (+ 1 2)}');
        $hash = $this->eval->getReturn($ast);
        $this->assertInstanceOf('Desmond\\data_types\\IntegerType', $hash->get(':key'));
        $this->assertEquals(3, $hash->get(':key')->value());
    }

    public function testDefine()
    {
        $ast = $this->lexer->readString('(define my-sym "it worked")');
        $this->eval->getReturn($ast);
        $ast = $this->lexer->readString('my-sym');
        $this->assertEquals('it worked', $this->eval->getReturn($ast)->value());
    }

    public function testDefinedSymInForm()
    {
        $ast = $this->lexer->readString('(define :five 5)');
        $this->eval->getReturn($ast);
        $ast = $this->lexer->readString('(+ 1 :five)');
        $this->assertEquals(6, $this->eval->getReturn($ast)->value());
    }

    public function testLet()
    {
        $ast = $this->lexer->readString('(let {:num 5} :num)');
        $letBlock = $this->eval->getReturn($ast);
        $this->assertInstanceOf('Desmond\\data_types\\IntegerType', $letBlock);
        $this->assertEquals(5, $letBlock->value());
    }

    public function testLetIsOwnEnvironment()
    {
        $ast = $this->lexer->readString('(let {:num 5} :num)');
        $this->eval->getReturn($ast);
        $ast = $this->lexer->readString(':num');
        $this->assertNotEquals(5, $this->eval->getReturn($ast)->value());
    }

    public function testDo()
    {
        $ast = $this->lexer->readString('(do (define :five 5) (+ 1 :five))');
        $do = $this->eval->getReturn($ast);
        $this->assertEquals(6, $do->value());
    }

    public function testIf()
    {
        $ast = $this->lexer->readString('(if true "yay")');
        $result = $this->eval->getReturn($ast);
        $this->assertEquals('yay', $result->value());

        $ast = $this->lexer->readString('(if false "nope")');
        $result = $this->eval->getReturn($ast);
        $this->assertNull($result->value());
    }

    public function testIfElse()
    {
        $ast = $this->lexer->readString('(if false "yep" "nope")');
        $result = $this->eval->getReturn($ast);
        $this->assertEquals('nope', $result->value());
    }
}
