<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ListTest extends TestCase
{
    use RunnerTrait;
    
    public function testNestedForms()
    {
        $this->assertEquals(10, $this->valueOf('(+ 1 2 (+ 3 4))'));
        $this->assertEquals(14, $this->valueOf('(+ 1 2 (+ 3 4) (- 6 2))'));
    }
}
