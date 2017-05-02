<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Desmond.php';

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
}
