<?php
namespace Desmond\test\functions\special;
use PHPUnit\Framework\TestCase;
use Desmond\test\helpers\RunnerTrait;

class TryCatchTest extends TestCase
{
    use RunnerTrait;

    public function testTry()
    {
        $message = $this->valueOf('(try (/) (catch message message))');
        $this->assertEquals('"/" expects argument 1 to be a Number.', $message);
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoBody()
    {
        $this->resultOf('(try)');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoCatch()
    {
        $this->resultOf('(try "meh")');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNotACatch()
    {
        $this->resultOf('(try "meh" (str "test"))');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testEmptyCatch()
    {
        $this->resultOf('(try "meh" (catch))');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testInvalidBinding()
    {
        $this->resultOf('(try "meh" (catch 5 "return"))');
    }

    /**
     * @expectedException Desmond\exceptions\ArgumentException
     */
    public function testNoCatchBody()
    {
        $this->resultOf('(try "meh" (catch error-message ))');
    }
}
