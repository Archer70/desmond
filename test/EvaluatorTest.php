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
        $this->assertEquals(5, $this->valueOf('5'));
    }

    public function testNestedForms()
    {
        $this->assertEquals(10, $this->valueOf('(+ 1 2 (+ 3 4))'));
        $this->assertEquals(14, $this->valueOf('(+ 1 2 (+ 3 4) (- 6 2))'));
    }

    public function testVector()
    {
        $vector = $this->resultOf('[1 2]');
        $this->assertInstanceOf('Desmond\\data_types\\VectorType', $vector);
        $this->assertEquals(2, $vector->get(1)->value());
    }

    public function testVectorEvaluatesForms()
    {
        $vector = $this->resultOf('[(+ 2 3)]');
        $this->assertEquals(5, $vector->get(0)->value());
    }

    public function testVectorEvaluatesSymbols()
    {
        $vector = $this->resultOf('(do (define x 2) [1 x])');
        $this->assertEquals(2, $vector->get(1)->value());
    }

    public function testHash()
    {
        $hash = $this->resultOf('{:key 1}');
        $this->assertInstanceOf('Desmond\\data_types\\HashType', $hash);
        $this->assertEquals(1, $hash->get(':key')->value());
    }

    public function testHashEvaluatesForms()
    {
        $hash = $this->resultOf('{:key (+ 1 2)}');
        $this->assertInstanceOf('Desmond\\data_types\\IntegerType', $hash->get(':key'));
        $this->assertEquals(3, $hash->get(':key')->value());
    }

    public function testDefine()
    {
        $this->assertEquals('it worked', $this->valueOf('(define my-sym "it worked")'));
    }

    public function testDefineCondition()
    {
        $result = $this->resultOf('(define :hello (if true "world" "universe"))');
        $this->assertInstanceOf('Desmond\\data_types\\StringType', $result);
        $this->assertEquals('world', $result->value());
    }

    public function testDefinedSymInForm()
    {
        $this->assertEquals(
            6, $this->valueOf('(do (define :five 5) (+ 1 :five))'));
    }

    public function testLet()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\IntegerType', $this->resultOf('(let {:num 5} :num)'));
        $this->assertEquals(
            5, $this->valueOf('(let {:num 5} :num)'));
    }

    public function testLetIsOwnEnvironment()
    {
        $this->assertNotEquals(
            5, $this->valueOf('(do (let {:num 5} :num) :num)'));
    }

    public function testDo()
    {
        $this->assertEquals(
            6, $this->valueof('(do (define :five 5) (+ 1 :five))'));
    }

    public function testIf()
    {
        $this->assertEquals('yay', $this->valueOf('(if true "yay")'));
        $this->assertNull($this->valueOf('(if false "nope")'));
    }

    public function testIfElse()
    {
        $this->assertEquals(
            'nope', $this->valueOf('(if false "yep" "nope")'));
    }

    public function testLamda()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\LambdaType', $this->resultOf('(lambda [arg] arg)'));
    }

    public function testEvalutationOfLambda()
    {
        $this->assertEquals(
            'executed!', $this->valueOf('((lambda [arg] arg) "executed!")'));

        $this->assertEquals(
            3, $this->valueOf('((lambda [:x :y] (+ :x :y)) 1 2)'));
    }

    public function testDefineLambda()
    {
        $this->assertEquals(3, $this->valueOf('
            (do
                (define my-func
                    (lambda [:x :y]
                        (+ :x :y)
                    )
                )
                (my-func 1 2)
            )'));
    }

    public function testLambdaEvaluatesParams()
    {
        $this->assertEquals(3, $this->valueOf('
            (do
                (define :x 1)
                (define :y 2)
                ((lambda [:num1 :num2]
                    (+ :num1 :num2)
                ) :x :y)
            )'));
    }

    public function testEval()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\SymbolType', $this->resultOf('(eval :sym)'));
        $this->assertEquals(3,
            $this->valueOf('(eval (ast "(+ 1 2)"))'));
    }

    public function testLoadFile()
    {
        $this->expectOutputString("30");
        $this->resultOf(
            '(load-file "' . __DIR__ . '/desmond_files/print-math.dsmnd")');
    }

    private function resultOf($string)
    {
        $ast = $this->lexer->readString($string);
        return $this->eval->getReturn($ast);
    }

    private function valueOf($string)
    {
        return $this->resultOf($string)->value();
    }
}
