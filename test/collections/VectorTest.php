<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class VectorTest extends TestCase
{
    use RunnerTrait;

    public function testVector()
    {
        $vector = $this->resultOf('[1 2]');
        $this->assertInstanceOf('Desmond\\data_types\\VectorType', $vector);
        $this->assertEquals(2, $vector->get(1)->value());
    }

    public function testVectorEvaluatesForms()
    {
        $vector = $this->resultOf('[(+ 2 3)]');
        $this->assertEquals(5, $vector->get(0)->value());
    }

    public function testVectorEvaluatesSymbols()
    {
        $vector = $this->resultOf('(do (define x 2) [1 x])');
        $this->assertEquals(2, $vector->get(1)->value());
    }
}
