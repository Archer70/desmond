<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ListQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testListQuestion()
    {
        $this->assertTrue($this->valueOf('(list? (list))'));
    }

    public function testNotList()
    {
        $this->assertFalse($this->valueOf('(list? [])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "list?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(list?)');
    }
}
