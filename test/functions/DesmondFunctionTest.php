<?php
namespace Desmond\test\functions;
use Desmond\functions\DesmondFunction;
use PHPUnit\Framework\TestCase;

class FunctionMock extends DesmondFunction
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

class DesmondFunctionTest extends TestCase
{
    private $func;

    public function setUp()
    {
        $this->func = new FunctionMock();
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