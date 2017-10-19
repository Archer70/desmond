<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class SubString implements Doc
{
    public function id()
    {
        return 'sub-string';
    }

    public function synopsis()
    {
        return 'Grabs a portion of a string. Same as PHP\'s substr().';
    }

    public function usage()
    {
        return '(sub-string string:String start:Number [length:Number])';
    }

    public function examples()
    {
        return [
            '(sub-string "test" 2)',
            '(sub-string "test" 2 1)'
        ];
    }
}