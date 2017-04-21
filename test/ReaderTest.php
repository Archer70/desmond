<?php
use PHPUnit\Framework\TestCase;
use Desmond\Reader;

class ReaderTest extends TestCase
{
    public function testPeek()
    {
        $reader = new Reader(str_split('test', 1));
        $this->assertEquals('t', $reader->peek());
    }

    public function testNext()
    {
        $reader = new Reader(str_split('test', 1));
        $reader->next();
        $reader->next();
        $this->assertEquals('s', $reader->peek());
    }
}