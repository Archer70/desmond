<?php
namespace Desmond\test\collections;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DoTest extends TestCase
{
    use RunnerTrait;

    public function testDo()
    {
        $this->assertEquals(
            6, $this->valueof('(do (define :five 5) (+ 1 :five))'));
    }
}
