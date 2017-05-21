<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EmptyQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testEmpty()
    {
        $this->assertTrue($this->valueOf('(empty? [])'));
    }

    public function testNotEmpty()
    {
        $this->assertFalse($this->valueOf('(empty? [1 2 3])'));
    }

    public function testStringEmpty()
    {
        $this->assertFalse($this->valueOf('(empty? "test")'));
    }

    public function testEmptyNil()
    {
        $this->assertTrue($this->valueOf('(empty? nil)'));
    }

    public function testNoArgsEmpty()
    {
        $this->assertTrue($this->valueOf('(empty?)'));
    }
}
