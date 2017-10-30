<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;
use Desmond\Desmond;
use Desmond\test_framework\TestRunner;

class Describe extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'describe';
    }

    public function run(array $args)
    {
        $this->expectArguments('describe', [['String']], $args);
        $reporter = TestRunner::reporter();
        $testName = $args[0]->value();
        $reporter::setTestName($testName);
        return $this->newReturnType('Void');
    }
}
