<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class HashQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testHashQuestion()
    {
        $this->assertTrue($this->valueOf('(hash? {})'));
    }

    public function testNotHash()
    {
        $this->assertFalse($this->valueOf('(hash? [])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "hash?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(hash?)');
    }
}
