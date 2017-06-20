<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LessThanTest extends TestCase
{
    use RunnerTrait;

    public function testLessThan()
    {
        $this->assertTrue($this->valueOf('(< 5 4)'));
    }
    
    public function testNotLessThan()
    {
		$this->assertFalse($this->valueOf('(< 4 5)'));
	}
	
	public function testMultipleLessThan()
	{
		$this->assertTrue($this->valueOf('(< 5 4 3 2 1)'));
	}
	
	/**
	 * @expectedException Desmond\exceptions\ArgumentException
	 */
	public function testNotNumber()
	{
		$this->resultOf('(< 5 4 3 2 "one")');
	}
}
