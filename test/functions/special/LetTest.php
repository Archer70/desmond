<?php
namespace Desmond\test\functions\special;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class LetTest extends TestCase
{
    use RunnerTrait;

    public function testLetReturnLastValue()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\NumberType', $this->resultOf('(let {:num 5} :num)'));
        $this->assertEquals(
            5, $this->valueOf('(let {:num 5} :num)'));
    }

    public function testLetIsOwnEnvironment()
    {
        $this->assertNotEquals(
            5, $this->valueOf('(do (let {:num 5} :num) :num)'));
    }
}
