<?php
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class EvaluatorTest extends TestCase
{
    use RunnerTrait;

    public function testReturnsAtom()
    {
        $this->assertEquals(5, $this->valueOf('5'));
    }

    public function testReturnsFunctionValue()
    {
        $this->assertEquals(5, $this->valueOf('(+ 2 3)'));
    }

    public function testGetSymFromNamespace()
    {
        $this->assertEquals(7, $this->valueOf('
            (do
                (namespace my-space
                    (define number 7))
                /my-space/number
            )'
        ));
    }

    public function testGetSymFromNamespaceWithoutLeadingSlash()
    {
        $this->assertEquals(7, $this->valueOf('
            (do
                (namespace my-space
                    (define number 7))
                my-space/number
            )'
        ));
    }

    public function testUndefinedNamespaceSym()
    {
        $this->assertEquals('nope/number', $this->valueOf('
            nope/number'
        ));
    }
}
