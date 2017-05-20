<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class NumberQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testNumberQuestion()
    {
        $this->assertTrue($this->valueOf('(number? 7)'));
    }

    public function testFloat()
    {
        $this->assertTrue($this->valueOf('(number? 4.20)'));
    }

    public function testNotNumber()
    {
        $this->assertFalse($this->valueOf('(number? "number")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "number?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(number?)');
    }
}
