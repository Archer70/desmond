<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class TrueQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testTrueQuestion()
    {
        $this->assertTrue($this->valueOf('(true? true)'));
    }

    public function testNotTrue()
    {
        $this->assertFalse($this->valueOf('(true? false)'));
    }

    public function testVectorNotTrue()
    {
        $this->assertFalse($this->valueOf('(true? [1, 2])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "true?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(true?)');
    }
}
