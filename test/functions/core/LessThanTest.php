<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LessThanTest extends TestCase
{
    use RunnerTrait;

    public function testLessThan()
    {
        $this->assertFalse($this->valueOf('(< 5 4)'));
    }

    public function testEqualTo()
    {
        $this->assertFalse($this->valueOf('(< 5 5)'));
    }
    
    public function testNotLessThan()
    {
		$this->assertTrue($this->valueOf('(< 4 5)'));
	}
	
	public function testMultipleLessThan()
	{
		$this->assertTrue($this->valueOf('(< 1 2 3 4 5)'));
	}
	
	/**
	 * @expectedException \Desmond\exceptions\ArgumentException
	 */
	public function testNotNumber()
	{
		$this->resultOf('(< 1 2 3 4 5 "six")');
	}
}
