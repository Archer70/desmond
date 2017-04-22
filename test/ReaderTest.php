<?php
use PHPUnit\Framework\TestCase;
use Desmond\Reader;

class ReaderTest extends TestCase
{
    private $reader;

    public function setUp()
    {
        $this->reader = new Reader(str_split('test', 1));
    }

    public function testPeek()
    {
        $this->assertEquals('t', $this->reader->peek());
    }

    public function testNext()
    {
        $this->reader->next();
        $this->reader->next();
        $this->assertEquals('s', $this->reader->peek());
    }

    public function testPeekReturnsNullIfEndOfTokens()
    {
        $this->reader->next();
        $this->reader->next();
        $this->reader->next();
        $this->reader->next();
        $this->assertNull($this->reader->peek());
    }
}