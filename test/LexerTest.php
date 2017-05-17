<?php
use PHPUnit\Framework\TestCase;
use Desmond\Lexer;
use Desmond\data_types\VectorType;
use Desmon\data_types\HashType;

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

    public function testFloat()
    {
        $this->assertEquals(4.20, $this->lexer->readString('4.20')->value());
        $this->assertEquals(-4.20, $this->lexer->readString('-4.20')->value());
    }

    public function testString()
    {
        $this->assertEquals('This is a string.', $this->lexer->readString('"This is a string."')->value());
        $this->assertEquals('String with " quote.', $this->lexer->readString('"String with \" quote."')->value());
        $this->assertEquals('new '."\n".' line', $this->lexer->readString('"new \n line"')->value());
        $this->assertEquals("new\nline.",
            $this->lexer->readString('"new
line."'));
    }

    public function testSymbol()
    {
        $symbol = $this->lexer->readString('my-sym');
        $this->assertInstanceOf('Desmond\data_types\SymbolType', $symbol);
        $this->assertEquals('my-sym', $symbol->value());
    }

    public function testVector()
    {
        $tree = $this->lexer->readString('[1 2 3]');
        $this->assertEquals(3, $tree->count());
        $this->assertEquals(2, $tree->get(1)->value());
    }

    public function testMultiLevelVectors()
    {
        $tree = $this->lexer->readString('[1 2 [3 4]]');
        $nestedVector = $tree->get(2);
        $this->assertTrue($nestedVector instanceof VectorType);
        $this->assertEquals(3, $nestedVector->get(0)->value());
    }

    public function testHash()
    {
        $tree = $this->lexer->readString('{key "val"}');
        $this->assertInstanceOf('Desmond\\data_types\\HashType', $tree);
        $this->assertInstanceOf('Desmond\\data_types\\StringType', $tree->get('key'));
    }

    public function testMultipleHashPairs()
    {
        $tree = $this->lexer->readString('{:key1 "one" :key2 "two"}');
        $this->assertEquals('one', $tree->get(':key1')->value());
        $this->assertEquals('two', $tree->get(':key2')->value());
    }

    public function testNestedHashes()
    {
        $tree = $this->lexer->readString('{:key {:nested 1}}');
        $this->assertInstanceOf('Desmond\\data_types\\NumberType', $tree->get(':key')->get(':nested'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Unexpected end of hash. Every key must have a value.
     */
    public function testUnmatchedHashKey()
    {
        $this->lexer->readString('{:one "val" :two}');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Expected "}", found EOF.
     */
    public function testUnmatchedCurlyBrace()
    {
        $this->lexer->readString('{:one "one"');
    }

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
        $this->assertInstanceOf('Desmond\data_types\NumberType', $tree->get(0));
        $this->assertInstanceOf('Desmond\data_types\NumberType', $tree->get(1)->get(0));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Expected ")", found EOF.
     */
    public function testUnmatchedClosingParen()
    {
        $this->lexer->readString('(+ 1 2');
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Unexpected )
    */
    public function testUnexpectedListEnd()
    {
        $this->lexer->readString(')');
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Unexpected ]
    */
    public function testUnexpectedVectorEnd()
    {
        $this->lexer->readString(']');
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Unexpected }
    */
    public function testUnexpectedHashEnd()
    {
        $this->lexer->readString('}');
    }

    public function testIfForm()
    {
        $result = $this->lexer->readString('(if false "yes" "no")');
        $this->assertEquals('yes', $result->get(2)->value());
    }
}
