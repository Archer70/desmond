<?php
use PHPUnit\Framework\TestCase;
use Desmond\Lexer;

class LexerTest extends TestCase
{
    private $lexer;

    public function setUp()
    {
        $this->lexer = new Lexer();
    }

    public function testNull()
    {
        $this->assertNull($this->lexer->readString('nil'));
    }

    public function testTrue()
    {
        $this->assertTrue($this->lexer->readString('true'));
    }

    public function testFalse()
    {
        $this->assertFalse($this->lexer->readString('false'));
    }

    public function testInt()
    {
        $this->assertEquals(1, $this->lexer->readString('1'));
        $this->assertEquals(-2, $this->lexer->readString('-2'));
    }

    public function testString()
    {
        $this->assertEquals('This is a string.', $this->lexer->readString('"This is a string."'));
        $this->assertEquals('String with " quote.', $this->lexer->readString('"String with \" quote."'));
        $this->assertEquals('new '."\n".' line', $this->lexer->readString('"new \n line"'));
    }

    public function testSymbol()
    {
        $symbol = $this->lexer->readString('my-sym');
        $this->assertInstanceOf('Desmond\data_types\Symbol', $symbol);
        $this->assertEquals('my-sym', $symbol->getName());
    }

    public function testForm()
    {
        $tree = $this->lexer->readString('(+ 1 2)');
        $this->assertEquals(3, count($tree));
        $this->assertEquals('+', $tree[0]->getName());
        $this->assertEquals(1, $tree[1]);
        $this->assertEquals(2, $tree[2]);
    }
}