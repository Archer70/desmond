<?php
namespace Desmond\test\functions;
use PHPUnit\Framework\TestCase;
use Desmond\functions\DocLibrary;

class DocLibraryTest extends TestCase
{
    public function setUp()
    {
        $this->lib = new DocLibrary();
    }

    public function testIndexesDocs()
    {
        $this->lib->index();
        $this->assertArrayHasKey('+', $this->lib->library());
    }
}
