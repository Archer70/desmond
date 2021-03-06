<?php
use Desmond\Desmond;
use PHPUnit\Framework\TestCase;

class DesmondTest extends TestCase
{
    private $desmond;

    public function setUp()
    {
        $this->desmond = new Desmond();
    }

    public function testRunsProgram()
    {
        $this->assertEquals(3, $this->desmond->run('(+ 1 2)')->value());
    }

    public function testKeepsState()
    {
        $this->desmond->run('(define :a 10)');
        $this->assertEquals(10, $this->desmond->run(':a')->value());
    }

    public function testReturnsEmptyStringIfNoCode()
    {
        $this->assertEquals('', $this->desmond->run(''));
    }

    public function testGetsPrettyString()
    {
        $this->assertEquals('(1, 2, 3)', $this->desmond->pretty($this->desmond->run('(list 1 2 3)')));
    }

    public function testPrettyStringNoToStringIfAlreadyString()
    {
        $value = $this->desmond->pretty(
            $this->desmond->run('(list 1 2 3'));
        $this->assertEquals('Expected ")", found EOF.', $value);
    }

    public function testLoadsFile()
    {
        $this->expectOutputString('30');
        $this->desmond->loadFile(__DIR__ . '/desmond_files/print-math.dsmnd');
    }
}
