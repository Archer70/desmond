<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class NilQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testNilQuestion()
    {
        $this->assertTrue($this->valueOf('(nil? nil)'));
    }

    public function testNotNil()
    {
        $this->assertFalse($this->valueOf('(nil? true)'));
    }

    public function testFalseNotNil()
    {
        $this->assertFalse($this->valueOf('(nil? false)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "nil?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(nil?)');
    }
}
