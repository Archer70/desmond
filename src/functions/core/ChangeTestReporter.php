<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\test_framework\TestRunner;

class ChangeTestReporter extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'change-test-reporter';
    }

    public function run(array $args)
    {
        $this->expectArguments(
            'change-test-reporter',
            [['String']],
            $args
        );
        $reporter = $args[0]->value();
        $result = TestRunner::changeReporter($reporter);
        return $result
            ? $this->newReturnType('True')
            : $this->newReturnType('False');
    }
}
