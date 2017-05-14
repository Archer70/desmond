<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LoadFileTest extends TestCase
{
    use RunnerTrait;

    public function testLoadFile()
    {
        $this->expectOutputString("30");
        $this->resultOf(
            '(load-file "' . __DIR__ . '/../../desmond_files/print-math.dsmnd")');
    }
}