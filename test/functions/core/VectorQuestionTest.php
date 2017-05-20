<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class VectorQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testVectorQuestion()
    {
        $this->assertTrue($this->valueOf('(vector? [])'));
    }

    public function testNotVector()
    {
        $this->assertFalse($this->valueOf('(vector? {})'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "vector?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(vector?)');
    }
}
