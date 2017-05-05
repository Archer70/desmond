<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DPrintTest extends TestCase
{
    use RunnerTrait;

    public function testPrint()
    {
        $this->expectOutputString('test words');
        $this->resultOf('(print "test words")');
    }
}
