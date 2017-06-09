<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class SplitTest extends TestCase
{
    use RunnerTrait;

    public function testSplitting()
    {
        $this->assertEquals(
            $this->valueOf('["1" "2" "3"]'),
            $this->valueOf('(split "," "1,2,3")'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoSplitter()
    {
        $this->resultOf('(split)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoString()
    {
        $this->resultOf('(split "/")');
    }
}
