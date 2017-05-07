<?php
namespace Desmond\test\functions;
use PHPUnit\Framework\TestCase;
use Desmond\functions\FileOperations;

class FileOperationsTest extends TestCase
{
    public function testGetsDocFileList()
    {
        $this->assertContains('Add.php', FileOperations::getDocFiles());
    }

    public function testGetsFunctionFileList()
    {
        $this->assertContains('Add.php', FileOperations::getFunctionFiles());
    }
}
