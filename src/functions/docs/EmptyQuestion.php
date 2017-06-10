<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class EmptyQuestion implements Doc
{
    public function id()
    {
        return 'empty?';
    }

    public function synopsis()
    {
        return 'Returns boolean true or false based on whether the supplied argument is empty. (php empty() function)';
    }

    public function usage()
    {
        return '(empty? <?argument:Mixed>)';
    }

    public function examples()
    {
        return [
            '(empty) #> true',
            '(empty nil) #> true',
            '(empty []) #> true',
            '(empty [1 2 3]) #> false',
            '(empty "something") #> false'
        ];
    }
}