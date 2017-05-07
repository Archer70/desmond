<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\functions\core\Dot;

class DotTest extends TestCase
{
    use RunnerTrait;

    public static $dummyArgs = [];

    public function setup()
    {
        self::$dummyArgs = [];
    }

    public function testCallsPHPFunction()
    {
        $this->assertEquals(
            '&lt;a', $this->resultOf('(. htmlspecialchars ["<a"])'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Dot called with no function argument. (. <func> [args..])
     */
    public function testExceptionIfNoFunctionNamed()
    {
        $this->resultOf('(. )');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Function "nofunc" not found.
     */
    public function testFailsIfFunctionDoesntExist()
    {
        $this->resultOf('(. nofunc)');
    }

    public function testCallsWithoutArgs()
    {
        $this->resultOf('(. \Desmond\test\functions\core\dummyFunction)');
        $this->assertEquals([null, null], self::$dummyArgs);
    }

    public function testCallsWithArgs()
    {
        $this->resultOf('(. \Desmond\test\functions\core\dummyFunction ["test" "arg"])');
        $this->assertEquals(['test', 'arg'], self::$dummyArgs);
    }
}

function dummyFunction($arg=null, $arg2=null)
{
    DotTest::$dummyArgs = [$arg, $arg2];
}
