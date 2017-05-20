<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LambdaQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testLambdaQuestion()
    {
        $this->assertTrue($this->valueOf('(lambda? (lambda [] :thing))'));
    }

    public function testNotLambda()
    {
        $this->assertFalse($this->valueOf('(lambda? :nope)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "lambda?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(lambda?)');
    }
}
