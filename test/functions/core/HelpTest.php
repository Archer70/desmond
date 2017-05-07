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
     * @expectedException Exception
     * @expectedExceptionMessage First argument must be a string.
     */
    public function testFirstArgumentIsString()
    {
        $this->resultOf('(help)');
    }
}
