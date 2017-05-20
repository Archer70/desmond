<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class SymbolQuestionTest extends TestCase
{
    use RunnerTrait;

    public function testSymbolQuestion()
    {
        $this->assertTrue($this->valueOf('(symbol? :yep)'));
    }

    public function testNotSymbol()
    {
        $this->assertFalse($this->valueOf('(symbol? "nope")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "symbol?" expects an argument.
     */
    public function testNoArgument()
    {
        $this->resultOf('(symbol?)');
    }
}
