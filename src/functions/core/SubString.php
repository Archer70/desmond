<?php
namespace Desmond\functions\core;
use Desmond\functions\DesmondFunction;
use Desmond\ArgumentHelper;
use Desmond\exceptions\ArgumentException;

class SubString extends DesmondFunction
{
    use ArgumentHelper;

    public function id()
    {
        return 'sub-string';
    }

    public function run(array $args)
    {
        $this->expectArguments('sub-string', [['String'], ['Number']], $args);
        $string = $args[0]->value();
        $start = $args[1]->value();

        if (isset($args[2]) && $this->isDesmondType('Number', $args[2])) {
            $length = $args[2]->value();
            $string = substr($string, $start, $length);
        } else {
            $string = substr($string, $start);
        }

        return $this->newReturnType('String', $string);
    }
}
