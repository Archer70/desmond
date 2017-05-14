<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DebugTest extends TestCase
{
    use RunnerTrait;

    public function testOutput()
    {
        $result = $this->valueOf('(debug [1 2 3])');
        $this->assertEquals('[1, 2, 3]', $result);
    }
}
