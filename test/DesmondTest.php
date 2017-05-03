<?php
use Desmond\Desmond;
use PHPUnit\Framework\TestCase;

class DesmondTest extends TestCase
{
    public function testRunsProgram()
    {
        $desmond = new Desmond();
        $this->assertEquals(3, $desmond->run('(+ 1 2)')->value());
    }

    public function testKeepsState()
    {
        $desmond = new Desmond();
        $desmond->run('(define :a 10)');
        $this->assertEquals(10, $desmond->run(':a')->value());
    }

    public function testGetsPrettyString()
    {
        $desmond = new Desmond();
        $this->assertEquals('(1, 2, 3)', $desmond->pretty($desmond->run('(list 1 2 3)')));
    }

    public function testPrettyStringNoToStringIfAlreadyString()
    {
        $desmond = new Desmond();
        $value = $desmond->pretty(
            $desmond->run('(list 1 2 3'));
        $this->assertEquals('Expected ")", found EOF.', $value);
    }
}
