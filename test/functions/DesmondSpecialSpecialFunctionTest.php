<?php
namespace Desmond\test\functions;
use Desmond\functions\DesmondSpecialFunction;
use PHPUnit\Framework\TestCase;

class SpecialFunctionMock extends DesmondSpecialFunction
{
    public function id()
    {
        return 'mock';
    }

    public function run(array $args)
    {
        return null;
    }
}

class DesmondSpecialFunctionTest extends TestCase
{
    private $func;

    public function setUp()
    {
        $this->func = new SpecialFunctionMock();
    }

    public function testToString()
    {
        $this->assertEquals('#<function> mock', $this->func->__toString());
    }

    public function testValue()
    {
        $this->assertEquals('#<function> mock', $this->func->value()->value());
    }
}