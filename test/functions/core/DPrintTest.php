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

    public function testMultipleStrings()
    {
        $this->expectOutputString('test words');
        $this->resultOf('(print "test " "words")');
    }

    public function testPrintVector()
    {
        $this->expectOutputString('[1, 2, 3]');
        $this->resultOf('(print [1 2 3])');
    }

    public function testPrintNothing()
    {
        $this->expectOutputString('');
        $this->resultOf('(print)');
    }
}
