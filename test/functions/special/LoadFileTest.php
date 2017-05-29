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

    public function testFileKnowsDir()
    {
        $file = __DIR__ . '/../../desmond_files/return-dir.dsmnd';
        $this->assertEquals(
            dirname(realpath(__DIR__ . '/../../desmond_files/return-dir.dsmnd')),
            $this->valueOf('(load-file "' . $file . '")')
        );
    }

    public function testFileKnowsFile()
    {
        $file = __DIR__ . '/../../desmond_files/return-file.dsmnd';
        $this->assertEquals(
            realpath($file),
            $this->valueOf('(load-file "' . $file . '")')
        );
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFileDoesntExist()
    {
        $this->resultOf('(load-file noop)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoFileName()
    {
        $this->resultOf('(load-file)');
    }
}
