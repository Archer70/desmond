<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Rest implements Doc
{
    public function id()
    {
        return 'rest';
    }

    public function synopsis()
    {
        return 'Takes a Vector or List and returns all the elements after the first. See also (help "first")';
    }

    public function usage()
    {
        return '(rest <collection:List|Vector>)';
    }

    public function examples()
    {
        return [
            '(rest [1 2 3 4])'
        ];
    }
}
