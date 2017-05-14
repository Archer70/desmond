<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class DotPost implements Doc
{
    public function id()
    {
        return '.post';
    }

    public function synopsis()
    {
        return 'Gets a value from PHP\'s $_POST super global.';
    }

    public function usage()
    {
        return '(.post <key:Symbol|String>)';
    }

    public function examples()
    {
        return [
            '(.post user-id)'
        ];
    }
}