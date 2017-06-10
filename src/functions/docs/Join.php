<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Join implements Doc
{
    public function id()
    {
        return 'join';
    }

    public function synopsis()
    {
        return 'Returns a string with the elements of a supplied collection join by a supplied separator.';
    }

    public function usage()
    {
        return '(join <separator:Symbol|String> <collection:List|Vector>)';
    }

    public function examples()
    {
        return [
            '(join ", " [1 2 3])'
        ];
    }
}