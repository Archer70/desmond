<?php
namespace Desmond\test\functions\core;
use PHPUnit\Framework\TestCase;
use Desmond\functions\core\Map;
use Desmond\test\helpers\RunnerTrait;
use Desmond\test\helpers\NumberTrait;

class MapTest extends TestCase
{
    use RunnerTrait;
    use NumberTrait;

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailsIfNoCollection()
    {
        $this->resultOf('(map)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testFailsIfNoCallback()
    {
        $this->resultOf('(map [])');
    }

    public function testMapsVector()
    {
        $code = '(map [1 2 3] (lambda [:value] (* :value 2)))';
        $this->assertInstanceOf('Desmond\\data_types\\VectorType',
            $this->resultOf($code)
        );
        $this->assertEquals($this->intList([2, 4, 6]),
            $this->valueOf($code)
        );
    }

    public function testMapsList()
    {
        $code = '(map (list 1 2 3) (lambda [:value] (* 2 :value)))';
        $this->assertInstanceOf('Desmond\\data_types\\ListType',
            $this->resultOf($code)
        );
        $this->assertEquals($this->intList([2, 4, 6]),
            $this->valueOf($code)
        );
    }

    public function testMapsHash()
    {
        $code = '(map {:one 1 :two 2 :three 3} (lambda [:value] (* 2 :value)))';
        $this->assertInstanceOf('Desmond\\data_types\\HashType',
            $this->resultOf($code)
        );
        $this->assertEquals(
            $this->valueOf('{:one 2 :two 4 :three 6}'),
            $this->valueOf($code)
        );
    }

    public function testMapsWithCoreFunction()
    {
        $this->assertEquals(
            $this->intList([1, 2, 3]),
            $this->valueOf('(map [-1 -2 -3] +)')
        );
    }

    public function testImmutable()
    {
        $this->assertEquals($this->valueOf('[-1 -2]'), $this->valueOf('
            (do
                (define vec [-1 -2])
                (map vec +)
                vec
            )
        '));
    }
}
