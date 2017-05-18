<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class FileContentsTest extends TestCase
{
    use RunnerTrait;

    public function testFileContents()
    {
        $file = __DIR__ . '/../../desmond_files/single-line.dsmnd';
        $this->assertEquals("(+ 1 2)\n", $this->valueOf('
            (do
                (define :file "'. $file. '")
                (file-contents :file))'));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @exectedExceptionMessage "file-contents": File "asdfa" not found.
     */
    public function testFileContentsNoFile()
    {
        $this->resultOf('(file-contents "asdfa")');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoFile()
    {
        $this->resultOf('(file-contents)');
    }
}
