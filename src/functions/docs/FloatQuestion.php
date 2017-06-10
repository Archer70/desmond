<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class FloatQuestion implements Doc
{
    public function id()
    {
        return 'float?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a floating point number, otherwise FALSE.';
    }

    public function usage()
    {
        return '(float? <number:Mixed>)';
    }

    public function examples()
    {
        return [
            '(float? 5) #> false',
            '(float? 5.1) #> true'
        ];
    }
}
