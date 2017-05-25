<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotGlobalTest extends TestCase
{
    use RunnerTrait;

    public function setUp()
    {
        global $myTest;
        $myTest = "ahh yeah";
    }

    public function testGetByKey()
    {
        $this->assertEquals('ahh yeah', $this->valueOf('(.global myTest)'));
    }

    public function testReturnsAllGlobals()
    {
        $this->assertArrayHasKey('myTest', $this->valueOf('(.global)'));
    }

    public function testSetsGlobal()
    {
        $this->assertEquals('changed', $this->valueOf('
            (do
                (.global myTest "changed")
            )
        '));
    }
}
