<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\Desmond;
use Desmond\test_framework\TestRunner;

class AssertTrue extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'assert-true';
    }

    public function run(array $args)
    {
        if (!isset($args[0])) {
            throw new ArgumentException('assert-true expects an argument.');
        }

        $actual = $args[0]->value();
        $message = isset($args[1]) ? $args[1]->value() : '';

        if ($actual == true) {
            $this->pass();
            return $this->newReturnType('True');
        } else {
            $this->fail('true', $actual, $message);
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
