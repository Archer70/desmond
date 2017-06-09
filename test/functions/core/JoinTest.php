<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class JoinTest extends TestCase
{
    use RunnerTrait;

    public function testJoining()
    {
        $this->assertEquals(
            $this->valueOf('"1, 2, 3"'),
            $this->valueOf('(join ", " [1 2 3])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoJoiner()
    {
        $this->resultOf('(join)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoCollection()
    {
        $this->resultOf('(join "/")');
    }
}
