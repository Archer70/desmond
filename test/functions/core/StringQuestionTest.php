<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class StringQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testStringQuestion()
    {
        $this->assertTrue($this->valueOf('(string? "yep")'));
    }

    public function testNotString()
    {
        $this->assertFalse($this->valueOf('(string? :nope)'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "string?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(string?)');
    }
}
