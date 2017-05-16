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
            '&lt;a', $this->resultOf('(.func htmlspecialchars "<a")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage ".func" expects argument 1 to be one of [Symbol, String].
     */
    public function testExceptionIfNoFunctionNamed()
    {
        $this->resultOf('(.func)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage ".func": undefined PHP function "nofunc".
     */
    public function testFailsIfFunctionDoesntExist()
    {
        $this->resultOf('(.func nofunc)');
    }

    public function testCallsWithoutUnrequiredArgs()
    {
        $this->resultOf('(.func \Desmond\test\functions\core\dummyFunction)');
        $this->assertEquals([null, null], self::$dummyArgs);
    }

    /**
    * @expectedException Desmond\exceptions\ArgumentException
    * @expectedExceptionMessage ".func": Too few arguments passed to Desmond\test\functions\core\requiredArgs.
    */
    public function testCallsWithoutRequiredArgs()
    {
        $this->resultOf('(.func Desmond\\test\\functions\\core\\requiredArgs)');
    }

    /**
    * @expectedException Desmond\exceptions\ArgumentException
    * @expectedExceptionMessage ".func": Too few arguments passed to htmlspecialchars.
    */
    public function testCallsPHPFunctionWithoutRequiredArgs()
    {
        $this->resultOf('(.func htmlspecialchars)');
    }

    public function testCallsWithArgs()
    {
        $this->resultOf('(.func \Desmond\test\functions\core\dummyFunction "test" "arg")');
        $this->assertEquals(['test', 'arg'], self::$dummyArgs);
    }
}

function requiredArgs($arg, $arg2)
{

}

function dummyFunction($arg=null, $arg2=null)
{
    DotFuncTest::$dummyArgs = [$arg, $arg2];
}
