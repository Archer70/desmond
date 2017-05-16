<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DebugDumpTest extends TestCase
{
    use RunnerTrait;

    public function testOutput()
    {
        $this->expectOutputRegex('/\[\]/');
        $this->resultOf('(debug-dump [])');
    }

    public function testOutputsNothingIfNoArgs()
    {
        $this->expectOutputString('');
        $this->resultOf('(debug-dump)');
    }
}
