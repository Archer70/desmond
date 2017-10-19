<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class SubStringTest extends TestCase
{
    use RunnerTrait;
    use NumberTrait;

    public function testTakesOffCharacter()
    {
        $this->assertEquals(
            'est', $this->valueOf('(sub-string "test" 1)'));
    }

    public function testTakesOffTwoCharacters()
    {
        $this->assertEquals(
            'st', $this->valueOf('(sub-string "test" 2)'));
    }

    public function testCapturesEndCharacters()
    {
        $this->assertEquals(
            'st', $this->valueOf('(sub-string "test" -2)'));
    }

    public function testLength()
    {
        $this->assertEquals(
            'this', $this->valueOf('(sub-string "get this text" 4 4)'));
    }
}
