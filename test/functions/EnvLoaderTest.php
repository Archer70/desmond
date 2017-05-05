<?php
namespace Desmond\test\functions;
use Desmond\functions\EnvLoader as Loader;
use Desmond\Environment;
use PHPUnit\Framework\TestCase;

class EnvLoaderTest extends TestCase
{
    public function testLoadsIntoEnv()
    {
        $env = new Environment();
        Loader::loadInto($env, 'core');
        $this->assertArrayHasKey('+', $env->values);
    }
}
