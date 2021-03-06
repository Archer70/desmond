<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class HelpTest extends TestCase
{
    use RunnerTrait;

    public function testHelp()
    {
        $this->assertRegExp('/\(\+ 1 2\)/', $this->valueOf('(help "+")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFirstArgumentIsString()
    {
        $this->resultOf('(help)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "help": Function "asdfads" not found.
     */
    public function testFunctionNotFound()
    {
        $this->resultOf('(help "asdfads")');
    }
}
