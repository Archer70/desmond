<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\Desmond;
use Desmond\test_framework\TestRunner;

class AssertEquals extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'assert-equals';
    }

    public function run(array $args)
    {
        if (!isset($args[0], $args[1])) {
            throw new ArgumentException('assert-equals expects at least two arguments.');
        }

        $expected = $args[0]->value();
        $actual = $args[1]->value();
        $message = isset($args[2]) ? $args[2]->value() : '';

        if ($expected == $actual) {
            $this->pass();
            return $this->newReturnType('True');
        } else {
            $this->fail($expected, $actual, $message);
            return $this->newReturnType('False');
        }
    }

    private function pass()
    {
        $reporter = TestRunner::reporter();
        $reporter::pass();
    }

    private function fail($expected, $actual, $message='')
    {
        $reporter = TestRunner::reporter();
        $reporter::fail($expected, $actual, $message);
    }
}
