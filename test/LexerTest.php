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

    public function testNoCodeIsNull()
    {
        $this->assertNull($this->lexer->readString(''));
    }

    public function testNull()
    {
        $this->assertNull($this->lexer->readString('nil')->value());
    }

    public function testTrue()
    {
        $this->assertTrue($this->lexer->readString('true')->value());
    }

    public function testFalse()
    {
        $this->assertFalse($this->lexer->readString('false')->value());
    }

    public function testInt()
    {
        $this->assertEquals(1, $this->lexer->readString('1')->value());
        $this->assertEquals(-2, $this->lexer->readString('-2')->value());
    }

    public function testString()
    {
        $this->assertEquals('This is a string.', $this->lexer->readString('"This is a string."')->value());
        $this->assertEquals('String with " quote.', $this->lexer->readString('"String with \" quote."')->value());
        $this->assertEquals('new '."\n".' line', $this->lexer->readString('"new \n line"')->value());
    }

    public function testSymbol()
    {
        $symbol = $this->lexer->readString('my-sym');
        $this->assertInstanceOf('Desmond\data_types\SymbolType', $symbol);
        $this->assertEquals('my-sym', $symbol->value());
    }

    // public function testVector()
    // {
    //     $tree = $this->lexer->readString('[1 2 3]');
    //     $this->assertEquals(3, count($tree));
    //     $this->assertEquals(2, $tree[2]->value());
    // }

    public function testForm()
    {
        $list = $this->lexer->readString('(+ 1 2)');
        $this->assertEquals(3, $list->count());
        $this->assertEquals('+', $list->get(0)->value());
        $this->assertEquals(1, $list->get(1)->value());
        $this->assertEquals(2, $list->get(2)->value());
    }

    public function testRecursiveTree()
    {
        $tree = $this->lexer->readString('(1 (2))');
        $this->assertInstanceOf('Desmond\data_types\IntegerType', $tree->get(0));
        $this->assertInstanceOf('Desmond\data_types\IntegerType', $tree->get(1)->get(0));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Expected ")", found EOL.
     */
    public function testUnmatchedClosingParen()
    {
        $this->lexer->readString('(+ 1 2');
    }
}
