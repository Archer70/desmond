<?php
use PHPUnit\Framework\TestCase;
use Desmond\Environment;

class EnvironmentTest extends TestCase
{
    private $env;

    public function setUp()
    {
        $this->env = new Environment();
    }

    public function testSet()
    {
        $this->env->set('sym1', 'val');
        $this->assertEquals('val', $this->env->get('sym1'));
    }

    public function testGet()
    {
        $this->env->set('get-key', 'get-val');
        $this->assertEquals('get-val', $this->env->get('get-key'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Symbol "no-such-key" not found in environment.
     */
    public function testKeyNotFoundError()
    {
        $this->env->get('no-such-key');
    }

    public function testExists()
    {
        $this->env->set('key', 'val');
        $this->assertTrue($this->env->exists('key'));
    }

    public function testDoesntExist()
    {
        $this->assertFalse($this->env->exists('doesnt exist'));
    }

    public function testMultiLayeredEnvironments()
    {
        // searching a low level bubbles up until it finds what we're looking for.
        $this->env->set('findme', 'found it!');
        $second = new Environment($this->env);
        $third = new Environment($second);
        $this->assertEquals('found it!', $third->get('findme'));
    }
}
