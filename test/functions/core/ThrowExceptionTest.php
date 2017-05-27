<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ThrowExceptionTest extends TestCase
{
    use RunnerTrait;

    /**
     * @expectedException Desmond\exceptions\LiveException
     * @expectedExceptionMessage Whelp..
     */
    public function testException()
    {
        $this->resultOf('(throw "Whelp..")');
    }

    public function testTryThrowCatch()
    {
        $message = $this->valueOf('
            (try (throw "Failed")
                (catch :message :message))');
        $this->assertEquals('Failed', $message);
    }
}
