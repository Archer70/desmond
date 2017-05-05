<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class PrintLineTest extends TestCase
{
    use RunnerTrait;

    public function testPrintLine()
    {
        $this->expectOutputString("test words\n");
        $this->resultOf('(print-line "test words")');
    }
}
