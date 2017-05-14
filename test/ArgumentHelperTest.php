<?php
namespace Desmond\test;
use PHPUnit\Framework\TestCase;
use Desmond\ArgumentHelper;
use Desmond\data_types\VectorType;

class ArgumentHelperTest extends TestCase
{
    use ArgumentHelper;

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "Function" expects argument 1 to be a Number.
     */
    public function testChecksArgExists()
    {
        $this->expectArguments('Function', [0 => ['Number']], $args = []);
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "Function" expects argument 1 to be a Number.
     */
    public function testChecksArgType()
    {
        $this->expectArguments(
            'Function',
            [0 => ['Number']],
            [new VectorType()]);
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage "Function" expects argument 1 to be one of [Number, String].
     */
    public function testMultipleTypePossiblitiesException()
    {
        $this->expectArguments(
            'Function',
            [0 => ['Number', 'String']],
            [new VectorType]
        );
    }

    public function testReturnsTrueIfAllTypesPass()
    {
        $this->assertTrue($this->expectArguments(
            'Function',
            [0 => ['Number', 'Vector']],
            [new VectorType()]
        ));
    }

    public function testNewReturnTypeNoArg()
    {
        $list = $this->newReturnType('List');
        $this->assertInstanceOf('Desmond\\data_types\\ListType', $list);
    }

    public function testNewReturnTypeWithArgs()
    {
        $list = $this->newReturnType('List', [1, 2]);
        $this->assertEquals(1, $list->get(0));
    }
}
