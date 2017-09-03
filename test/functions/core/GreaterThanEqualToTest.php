<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class GreaterThanEqualToTest extends TestCase
{
    use RunnerTrait;

    public function testGreaterThan()
    {
        $this->assertTrue($this->valueOf('(>= 5 4)'));
    }

    public function testEqualTo()
    {
        $this->assertTrue($this->valueOf('(>= 5 5)'));
    }
    
    public function testNotGreaterThan()
    {
		$this->assertFalse($this->valueOf('(>= 4 5)'));
	}
	
	public function testMultipleGreaterThan()
	{
		$this->assertTrue($this->valueOf('(>= 5 4 3 2 1)'));
	}
	
	/**
	 * @expectedException \Desmond\exceptions\ArgumentException
	 */
	public function testNotNumber()
	{
		$this->resultOf('(>= 5 4 3 2 "one")');
	}
}
