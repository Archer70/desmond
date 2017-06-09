<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class PopTest extends TestCase
{
    use RunnerTrait;

    public function testPops()
    {
        $this->assertEquals(
            $this->valueOf('[1 2 3]'),
            $this->valueOf('(pop [1 2 3 4])'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNotCollection()
    {
        $this->resultOf('(pop symbol)');
    }
}
