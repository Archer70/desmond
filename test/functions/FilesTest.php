<?php
use PHPUnit\Framework\TestCase;

class FilesTest extends TestCase
{
    use Desmond\test\helpers\RunnerTrait;

    public function testFileContents()
    {
        $file = __DIR__ . '/../desmond_files/single-line.dsmnd';
        $this->assertEquals("(+ 1 2)\n", $this->valueOf('
            (do
                (define :file "'. $file. '")
                (file-contents :file))'));
    }

    /**
     * @expectedException Exception
     * @exectedExceptionMessage File "asdfa" not found.
     */
    public function testFileContentsNoFile()
    {
        $this->resultOf('(file-contents "asdfa")');
    }
}
