<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class LambdaQuestion implements Doc
{
    public function id()
    {
        return 'lambda?';
    }

    public function synopsis()
    {
        return 'Returns TRUE if the supplied argument is a Lambda function, otherwise FALSE.';
    }

    public function usage()
    {
        return '(lambda? <func:Mixed>)';
    }

    public function examples()
    {
        return [
            '(lambda? my-func)'
        ];
    }
}