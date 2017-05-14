<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotGet implements Doc
{
    public function id()
    {
        return '.get';
    }

    public function synopsis()
    {
        return 'Gets a value from PHP\'s $_GET super global.';
    }

    public function usage()
    {
        return '(.get <key:Symbol|String>)';
    }

    public function examples()
    {
        return [
            '(.get name)'
        ];
    }
}