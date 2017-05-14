<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Nth implements Doc
{
    public function id()
    {
        return 'nth';
    }

    public function synopsis()
    {
        return 'Takes a List or Vector and returns the element at "nth" index (zero indexed).';
    }

    public function usage()
    {
        return '(nth <collection:List|Vector> <nth:Number>)';
    }

    public function examples()
    {
        return [
            '(nth [1 2 3 4] 1)'
        ];
    }
}
