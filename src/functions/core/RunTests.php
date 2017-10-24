<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\test_framework\TestRunner;

class RunTests extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'run-tests';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'change-test-reporter',
            [['String']],
            $args
        );
        $testDir = $args[0]->value();
        $runner = new TestRunner();
        $runner->runTests($testDir);
        return $this->newReturnType('Void');
    }
}
