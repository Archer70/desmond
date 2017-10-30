<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test_framework\reporters\Dotty;

class DescribeTest extends TestCase
{
    use RunnerTrait;

    public function testDescribing()
    {
        $this->expectOutputRegex('/described/');
        $path = __DIR__ . '/../../mocks/describe_files';
        $this->resultOf('(run-tests "'.$path.'")');
    }
}
