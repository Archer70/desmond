<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class DotPropertyTest extends TestCase
{
    use RunnerTrait;

    public function testGetsPropertyOfObject()
    {
        $this->assertEquals('test', $this->valueOf('
            (let
                {:object (.new Desmond\\test\\mocks\\GenericObject)}
                (.property :object property)
            )'
        ));
    }

    public function testNilIfNoObjectProperty()
    {
        $this->assertEquals(null, $this->valueOf('
            (let
                {:object (.new Desmond\\test\\mocks\\GenericObject)}
                (.property :object fakeProperty)
            )
        '));
    }

    public function testGetsPropertyOfClass()
    {
        $this->assertEquals('test', $this->valueOf('
            (.property Desmond\\test\\mocks\\GenericObject staticProperty)'
        ));
    }

    public function testNilIfNoClassProperty()
    {
        $this->assertEquals(null, $this->valueOf('
            (.property Desmond\\test\\mocks\\GenericObject fakeProperty)
        '));
    }

    public function testSetsInstanceProperty()
    {
        $this->assertEquals('newVal', $this->valueOf('
            (let
                {:object (.new stdClass)}
                (do
                    (.property :object new_property "newVal")
                    (.property :object new_property)
                )
            )
        '));
    }

    public function testReturnsPropertyValueOnSet()
    {
        $this->assertEquals('newVal', $this->valueOf('
        (let
            {:object (.new stdClass)}
            (.property :object new_property "newVal")
        )
        '));
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     * @expectedExceptionMessage .property: Static properties cannot be set from an external context.
     */
    public function testFailsToSetStaticProperty()
    {
        $this->resultOf('(.property stdClass staticProperty "val")');
    }
}
