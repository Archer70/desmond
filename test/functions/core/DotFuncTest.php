<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\functions\core\DotFunc;

class DotFuncTest extends TestCase
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
            '&lt;a', $this->resultOf('(.func htmlspecialchars ["<a"])'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage .func called with no function argument. (.func <func> [args..])
     */
    public function testExceptionIfNoFunctionNamed()
    {
        $this->resultOf('(.func )');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Function "nofunc" not found.
     */
    public function testFailsIfFunctionDoesntExist()
    {
        $this->resultOf('(.func nofunc)');
    }

    public function testCallsWithoutArgs()
    {
        $this->resultOf('(.func \Desmond\test\functions\core\dummyFunction)');
        $this->assertEquals([null, null], self::$dummyArgs);
    }

    public function testCallsWithArgs()
    {
        $this->resultOf('(.func \Desmond\test\functions\core\dummyFunction ["test" "arg"])');
        $this->assertEquals(['test', 'arg'], self::$dummyArgs);
    }
}

function dummyFunction($arg=null, $arg2=null)
{
    DotFuncTest::$dummyArgs = [$arg, $arg2];
}
