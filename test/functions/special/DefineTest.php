<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DefineTest extends TestCase
{
    use RunnerTrait;

    public function testDefine()
    {
        $this->assertEquals('it worked', $this->valueOf('(define my-sym "it worked")'));
    }

    public function testDefineCondition()
    {
        $result = $this->resultOf('(define :hello (if true "world" "universe"))');
        $this->assertInstanceOf('Desmond\\data_types\\StringType', $result);
        $this->assertEquals('world', $result->value());
    }

    public function testDefinedSymInForm()
    {
        $this->assertEquals(
            6, $this->valueOf('(do (define :five 5) (+ 1 :five))'));
    }
}
