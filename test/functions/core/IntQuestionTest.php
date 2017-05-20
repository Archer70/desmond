<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class IntQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testIntQuestion()
    {
        $this->assertTrue($this->valueOf('(int? 7)'));
    }

    public function testFloat()
    {
        $this->assertFalse($this->valueOf('(int? 4.20)'));
    }

    public function testNotInt()
    {
        $this->assertFalse($this->valueOf('(int? "7")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "int?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(int?)');
    }
}
