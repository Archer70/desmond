<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class FloatQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testFloatQuestion()
    {
        $this->assertTrue($this->valueOf('(float? 4.20)'));
    }

    public function testInt()
    {
        $this->assertFalse($this->valueOf('(float? 4)'));
    }

    public function testString()
    {
        $this->assertFalse($this->valueOf('(float? "7.1")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "float?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(float?)');
    }
}
