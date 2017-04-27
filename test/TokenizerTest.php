<?php
use PHPUnit\Framework\TestCase;
use Desmond\Tokenizer;

class TokenizerTest extends TestCase
{
    public function testReturnsEmptyArrayIfNoCode()
    {
        $this->assertEquals([], Tokenizer::tokenize(''));
    }

    public function testDoesNotMatchWhiteSpace()
    {
        $this->assertEquals([], Tokenizer::tokenize(" \t"));
    }

    public function testCapturesTildAt()
    {
        $this->assertEquals(['~@'], Tokenizer::tokenize('~@'));
    }

    public function testCapturesVectorChars()
    {
        $this->assertEquals(['[', ']'], Tokenizer::tokenize('[]'));
    }

    public function testCapturesMapChars()
    {
        $this->assertEquals(['{', '}'], Tokenizer::tokenize('{}'));
    }

    public function testCapturesListChars()
    {
        $this->assertEquals(['(', ')'], Tokenizer::tokenize('()'));
    }

    public function testCapturesSpecialChars()
    {
        $chars = ['\'', '`', '~', '^', '@'];
        $this->assertEquals($chars, Tokenizer::tokenize('\'`~^@'));
    }

    public function testCapturesStrings()
    {
        // This is the fun part.
        $this->assertEquals(['"this is a string."'], Tokenizer::tokenize('"this is a string."'));
    }

    public function testCapturesComments()
    {
        $this->assertEquals(['; this is a comment.'], Tokenizer::tokenize('; this is a comment.'));
    }

    public function testCapturesSymbols()
    {
        $this->assertEquals(['sym1', '1', '+'], Tokenizer::tokenize('sym1 1 +'));
    }

    public function testMap()
    {
        $this->assertEquals(['{', 'key', '"val"', '}'], Tokenizer::tokenize('{key "val"}'));
    }
}
