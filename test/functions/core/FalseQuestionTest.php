<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class FalseQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testFalseQuestion()
    {
        $this->assertTrue($this->valueOf('(false? false)'));
    }

    public function testNotFalse()
    {
        $this->assertFalse($this->valueOf('(false? true)'));
    }

    public function testVectorNotFalse()
    {
        $this->assertFalse($this->valueOf('(false? [])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "false?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(false?)');
    }
}
