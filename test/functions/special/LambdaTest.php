<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LambdaTest extends TestCase
{
    use RunnerTrait;

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
}
