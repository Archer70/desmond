<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class AstTest extends TestCase
{
    use RunnerTrait;

    public function testAst()
    {
        $ast = $this->resultOf('(ast "(+ 1 2 3)")');
        $this->assertEquals('+', $ast->get(0)->value());
        $this->assertEquals('/', $this->valueOf('(ast "/")'));
    }
}
