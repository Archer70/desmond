<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Let implements Doc
{
    public function id()
    {
        return 'let';
    }

    public function synopsis()
    {
        return 'Creates a localized environment/scope containing a group of symbols/values.
Those symbols will not have value outside of the let block.';
    }

    public function usage()
    {
        return '(let <Hash> <Mixed>)';
    }

    public function examples()
    {
        return [
            '(let {x 1, y 2} (+ x y))'
        ];
    }
}
