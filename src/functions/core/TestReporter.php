<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\test_framework\TestRunner;

class TestReporter extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'test-reporter';
    }

    public function run(array $args)
    {
        $reporter = TestRunner::reporter();
        return $this->newReturnType('String', $reporter::id());
    }
}
