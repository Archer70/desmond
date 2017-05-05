<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class HashTest extends TestCase
{
    use RunnerTrait;

    public function testHash()
    {
        $hash = $this->resultOf('{:key 1}');
        $this->assertInstanceOf('Desmond\\data_types\\HashType', $hash);
        $this->assertEquals(1, $hash->get(':key')->value());
    }

    public function testHashEvaluatesForms()
    {
        $hash = $this->resultOf('{:key (+ 1 2)}');
        $this->assertInstanceOf('Desmond\\data_types\\NumberType', $hash->get(':key'));
        $this->assertEquals(3, $hash->get(':key')->value());
    }
}
