<?php
use PHPUnit\Framework\TestCase;
use Desmond\functions\Core;
use Desmond\data_types\IntegerType;
use Desmond\data_types\SymbolType;
use Desmond\data_types\StringType;
use Desmond\data_types\TrueType;
use Desmond\data_types\FalseType;
use Desmond\data_types\NilType;


class CoreTest extends TestCase
{
    public function testAst()
    {
        $ast = Core::ast([new StringType("(+ 1 2)")]);
        $this->assertInstanceOf('Desmond\\data_types\\ListType', $ast);
        $this->assertEquals('+', $ast->get(0)->value());

        $ast = Core::ast([new StringType("/")]);
        $this->assertEquals('/', $ast->value());
    }

    public function testFileContents()
    {
        $contents = Core::file_contents(
            [new StringType(__DIR__ . '/../desmond_files/single-line.dsmnd')]);
        $this->assertInstanceOf('Desmond\\data_types\\StringType', $contents);
        $this->assertEquals("(+ 1 2)\n", $contents->value());
    }

    /**
     * @expectedException Exception
     * @exectedExceptionMessage File not found.
     */
    public function testFileContentsNoFile()
    {
        // TODO Make the exception message more specific.
        Core::file_contents('asdfa');
    }

    public function testAddition()
    {
        $int1 = new IntegerType(1);
        $int2 = new IntegerType(4);
        $this->assertEquals(5, Core::addition([$int1, $int2])->value());
    }

    public function testSubtraction()
    {
        $int1 = new IntegerType(1);
        $int2 = new IntegerType(4);
        $this->assertEquals(-3, Core::subtraction([$int1, $int2])->value());
    }

    public function testMultiplication()
    {
        $int1 = new IntegerType(2);
        $int2 = new IntegerType(4);
        $this->assertEquals(8, Core::multiplication([$int1, $int2])->value());
    }

    public function testDivision()
    {
        $int1 = new IntegerType(10);
        $int2 = new IntegerType(2);
        $this->assertEquals(5, Core::division([$int1, $int2])->value());
    }

    public function testEquals()
    {
        $equalArgs = [new IntegerType(7), new IntegerType(7), new IntegerType(7)];
        $unequalArgs = [new IntegerType(7), new IntegerType(7), new IntegerType(5)];
        $this->assertEquals(true, Core::equal($equalArgs)->value());
        $this->assertEquals(false, Core::equal($unequalArgs)->value());
    }

    public function testPrint()
    {
        $this->expectOutputString('test words');
        Core::outputPrint([new StringType('test'), new StringType(' words')]);
    }

    public function testPrintLine()
    {
        $this->expectOutputString("test words\n");
        Core::outputPrintLine([new StringType('test'), new StringType(' words')]);
    }

    public function testList()
    {
        $args = [
            new SymbolType('+'),
            new IntegerType(1),
            new IntegerType(2)
        ];
        $this->assertInstanceOf('Desmond\\data_types\\ListType', Core::newList($args));
        $this->assertInstanceOf('Desmond\\data_types\\SymbolType', Core::newList($args)->get(0));
    }
}
