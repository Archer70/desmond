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
        $this->reader->next()->next()->next()->next();
        $this->assertNull($this->reader->peek());
    }

    public function testHasNext()
    {
        $this->assertTrue($this->reader->hasNext());
        $this->reader->next()->next()->next();
        $this->assertFalse($this->reader->hasNext());
    }
}
