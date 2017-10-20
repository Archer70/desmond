<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class VersionTest extends TestCase
{
    use RunnerTrait;

    public function testVersion()
    {
        $this->assertRegExp(
            '/Desmond \d.\d.\d, PHP [\d\.]+\./',
            $this->valueOf('(version)'));
    }
}
