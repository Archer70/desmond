<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Range implements Doc
{
    public function id()
    {
        return 'range';
    }

    public function synopsis()
    {
        return 'Creates a range of numbers.';
    }

    public function usage()
    {
        return '(range <start:Number> <finish:Number>)';
    }

    public function examples()
    {
        return [
            '(range 0 5)'
        ];
    }
}