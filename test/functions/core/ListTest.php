<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class ListTest extends TestCase
{
    use RunnerTrait;

    public function testList()
    {
        $this->assertInstanceOf(
            'Desmond\\data_types\\ListType', $this->resultOf('(list (+ 1 2))'));
    }
}
