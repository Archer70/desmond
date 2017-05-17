<?php
namespace Desmond\test\data_types;
use PHPUnit\Framework\TestCase;
use Desmond\data_types\SymbolType;

class SymbolTest extends TestCase
{
    public function setUp()
    {
        $this->symbol = new SymbolType("Heyo");
    }

    public function testValue()
    {
        $this->assertEquals('Heyo', $this->symbol->value());
    }

    public function testToString()
    {
        $this->assertEquals('Heyo', $this->symbol->__toString());
    }
}
