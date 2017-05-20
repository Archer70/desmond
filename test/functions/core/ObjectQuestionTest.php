<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ObjectQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testObjectQuestion()
    {
        $this->assertTrue($this->valueOf('(object? (.new stdClass))'));
    }

    public function testNotObject()
    {
        $this->assertFalse($this->valueOf('(object? "nope")'));
    }

    public function testClassIsntObject()
    {
        $this->assertFalse($this->valueOf('(object? stdClass)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "object?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(object?)');
    }
}
