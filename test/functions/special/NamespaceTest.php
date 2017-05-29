<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class NamespaceTest extends TestCase
{
    use RunnerTrait;

    public function testNamespace()
    {
        $this->assertEquals(
            6, $this->valueof('
                (namespace "my-space"
                    (define :five 5)
                    (+ 1 :five)
                )'
            )
        );
    }

    public function testValuesDontCross()
    {
        $this->assertEquals(
            ':num', $this->valueOf('
            (do
                (namespace "my-space"
                    (define :num 5)
                )
                :num
            )')
        );
    }

    public function testCrossingVariablesInSameSpace()
    {
        $this->assertEquals(
            7, $this->valueOf('
                (do
                    (namespace "new-space" (define :my-num 7))
                    (namespace "new-space" :my-num)
                )
            ')
        );
    }

    public function testDoesntSmokeEnvironments()
    {
        $this->assertEquals(7, $this->valueOf('(namespace "new-space" (+ 1 6))'));
        $this->assertEquals(7, $this->valueOf('
            (do
                (namespace test-space
                    (define :number 2))
                (namespace test-space
                    (+ 5 :number))
            )
        '));
    }

    public function testWithLet()
    {
        $this->assertEquals(7, $this->valueOf('
            (let
                {:number 2}
                (namespace my-test
                    (+ 5 :number))
            )
        '));
    }
}
