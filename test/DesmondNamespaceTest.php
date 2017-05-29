<?php
namespace Desmond\test;
use PHPUnit\Framework\TestCase;
use Desmond\Environment;
use Desmond\DesmondNamespace as NS;

class DesmondNamespaceTest extends TestCase
{
    public function setUp()
    {
        NS::setRoot(new Environment);
    }

    public function testGetRoot()
    {
        $this->assertNotNull(NS::getRoot());
    }

    public function testCreate()
    {
        $root = NS::create('new-namespace', new Environment);
        $this->assertNotNull(NS::get('new-namespace'));
        $this->assertNotNull(NS::getRoot()->get('new-namespace'));
    }

    public function testExists()
    {
        NS::create('my-env', new Environment);
        $this->assertTrue(NS::exists('my-env'));
    }
}
