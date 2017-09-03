<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LessThanEqualToTest extends TestCase
{
    use RunnerTrait;

    public function testLessThan()
    {
        $this->assertTrue($this->valueOf('(<= 4 5)'));
    }

    public function testEqualTo()
    {
        $this->assertTrue($this->valueOf('(<= 5 5)'));
    }
    
    public function testNotLessThan()
    {
		$this->assertFalse($this->valueOf('(<= 5 4)'));
	}
	
	public function testMultipleLessThan()
	{
		$this->assertTrue($this->valueOf('(<= 1 2 3 4 5)'));
	}
	
	/**
	 * @expectedException Desmond\exceptions\ArgumentException
	 */
	public function testNotNumber()
	{
		$this->resultOf('(<= 1 2 3 4 "five")');
	}
}
