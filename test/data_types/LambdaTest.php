<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;

class LambdaTest extends TestCase
{
    use \Desmond\test\helpers\RunnerTrait;

    public function testHasId()
    {
        $lambda = $this->resultOf('(lambda [] "")');
        $this->assertEquals('anonymous', $lambda->id());
    }
}