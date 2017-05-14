<?php
namespace Desmond\functions\docs;
use Desmond\functions\Doc;

class Get implements Doc
{
    public function id()
    {
        return 'get';
    }

    public function synopsis()
    {
        return 'Gets a value from a collection; usually a Hash.';
    }

    public function usage()
    {
        return '(get <collection:Hash|Vector|List> <key:Symbol|String>)';
    }

    public function examples()
    {
        return [
            '(get {:key "value"} :key)'
        ];
    }
}