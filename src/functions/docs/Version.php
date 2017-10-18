<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Version implements Doc
{
    public function id()
    {
        return 'version';
    }

    public function synopsis()
    {
        return 'Returns the Desmond and PHP versions as a string.';
    }

    public function usage()
    {
        return '(desmond)';
    }

    public function examples()
    {
        return [
            '(desmond)'
        ];
    }
}